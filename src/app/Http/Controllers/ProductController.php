<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        // 2. クエリ（検索命令）の準備を始める
        $query = Product::query();

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
    public function show($productId)
    {
        // 指定されたIDの商品を1件だけ取得。季節（seasons）も一緒に連れてくる。
        $product = Product::with('seasons')->findOrFail($productId);
        return view('products.show', compact('product'));
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
    public function edit($productId)
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
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        $product->seasons()->sync($request->seasons);

        return redirect()->route('products.show', $product->id)->with('success', '更新しました');
    }
}
