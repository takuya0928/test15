<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Product::query();
        // キーワード検索
        if ($request->filled('keyword')){
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // メーカー検索
        if ($request->filled('maker')){
            $query->where('maker', 'like', '%' . $request->maker . '%');
        }

        // ページネーション（1ページ １０件表示）
        $products = $query->paginate(10)->withQueryString();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'maker' => 'required|string|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $image_path = null;
        if ($request->hasFile('image')){
            $image_path = $request->file('image')->store('images', 'public');
        }

        Product::create([
            'name' => $request->name,
            'maker' => $request->maker,
            'price' => $request->price,
            'stock' => $request->stock,
            'comment' => $request->comment,
            'image_path' => $image_path,
        ]);

        return redirect()->route('products.index')->with('success', '商品を登録しました');
        // 一覧ページへ
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'maker' => 'required|string|max:255',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'comment' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        $product = Product::findOrFail($id);

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_path = $imagePath;
        }

        $product->name = $request->name;
        $product->maker = $request->maker;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        $product->save();

        return redirect()->route('products.index')->with('success', '商品情報を更新しました。');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if($product->image_path && \Storage::exists('public/'.$product->image_path)) {
            \Storage::delete('public/'.$product->image_path);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました。');

    }
}
