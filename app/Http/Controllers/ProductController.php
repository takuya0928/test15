<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
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
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'description' => 'nullable|string',
        ]);
        try {
            DB::beginTransaction();
            Product::storeProduct($request->only(['name', 'price', 'description']));
            DB::commit();
            return redirect()->route('products.index')
            ->with('success', config('message.register_success'));
        }catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', config('message.register_error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
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
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'description' => 'nullable|string',
        ]);
        try {
            DB::beginTransaction();
            Product::updateProduct($id, $request->only(['name', 'price', 'description']));
            DB::commit();
            return redirect()->route('products.index')
            ->with('success', config('message.update_success'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', config('message.update_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            Product::deleteProduct($id);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => config('message.delete_success')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => config('message.delete_error'),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function search(Request $request)
    {
        $query = Product::query();
        // 名前検索
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        // 価格範囲
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // 在庫範囲
        if ($request->filled('stock_min')) {
            $query->where('stock', '>=', $request->stock_min);
        }
        if ($request->filled('stock_max')) {
            $query->where('stock', '<=', $request->stock_max);
        }

        // ソート
        $sort = in_array($request->sort, ['id', 'name', 'price', 'stock']) ? $request->sort : 'id';
        $direction = ($request->direction === 'asc') ? 'asc' : 'desc';
        $query->orderBy($sort, $direction);
        $products = $query->get();
        return view('products.partials.table', compact('products'));
    }
}
