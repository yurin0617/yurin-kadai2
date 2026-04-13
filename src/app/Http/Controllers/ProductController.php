<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Models\Season;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 1. 検索窓に入力された文字を受け取る
        $search = $request->search;

        $sort = $request->input('sort');

        // 修正ポイント：with('user') を追加して、ユーザー情報をまとめて取得
        $query = Product::with('user');

        // 3. もし検索文字があれば、名前にその文字が含まれる商品を絞り込む
        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        // 価格順並べ替え
        if ($sort === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'desc') {
            $query->orderBy('price', 'desc');
        }

        // FN006: 6件ごとのページネーション
        $products = $query->paginate(6);
        return view('products.index', compact('products'));
    }
    // 登録画面を表示する
    public function create()
    {
        return view('products.register'); // products/register.blade.php を表示
    }

    // 保存処理（今はまだ何もしない）
    public function store(StoreProductRequest $request)
    {
        // 1. バリデーション済みのデータを受け取る
        $validated = $request->validated();

        // 2. 画像の保存処理 (public/storage/products フォルダに保存)
        $imagePath = $request->file('image')->store('products', 'public');

        // 3. データベースへ保存 (Productモデルを使用)
        $product = Product::create([
            'user_id'        => Auth::id(), // ログイン中のユーザーIDを保存
            'name'        => $validated['name'],
            'price'       => $validated['price'],
            'image'       => $imagePath, // 保存したパスをいれる
            'description' => $validated['description'],
        ]);

        // 4. 季節（中間テーブル）の保存 (FN012)
        // 多対多のリレーションが設定されていれば sync で一気に保存できます
        $product->seasons()->sync($request->seasons);

        // 5. 完了メッセージを出して一覧に戻る
        return redirect()->route('products.index')->with('success', '商品を登録しました');
    }

    public function show($productId)
    {
        // 編集対象の商品を取得（リレーションも一緒に）
        $product = Product::with('seasons')->findOrFail($productId);

        // チェックボックスの選択肢として使うために全季節を取得
        $seasons = Season::all();

        return view('products.edit', compact('product', 'seasons'));
    }
    public function update(UpdateProductRequest $request, $productId)
    {
        // ここで $request->validate(...) を書く必要はありません。
        // このメソッドが動く前に、Laravelが自動で「別シート」のルールをチェックしてくれます！

        $product = Product::findOrFail($productId);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        $product->seasons()->sync($request->seasons);

        return redirect()->route('products.index');
    }
    public function destroy($productId)
    {
        // 1. 削除対象の商品を見つける
        $product = Product::findOrFail($productId);

        // 2. 画像ファイルが登録されていれば、ストレージから物理削除
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // 3. データベースから商品を削除
        // 中間テーブル（seasons）との紐付けも、モデルの設定（cascade等）があれば自動、
        // もしくは $product->seasons()->detach(); をここで呼ぶと確実です。
        $product->delete();

        // 4. 一覧画面に戻り、メッセージを表示
        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }
}
