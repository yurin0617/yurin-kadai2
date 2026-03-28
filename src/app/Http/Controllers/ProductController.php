<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // 全商品を取得（あとで検索や並べ替えを追加しますが、まずは全件！）
        $products = Product::all();

        // view（画面）にデータを渡して表示
        return view('products.index', compact('products'));
    }
}
