<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['error' => '商品が見つかりません'], 404);
        }
        if ($product->stock <= 0) {
            return response()->json(['error' => '在庫がありません'], 400);
        }

        try {
            DB::transaction(function () use ($product) {
                // 在庫を減らす
                $product->decrement('stock');
                // salesテーブルに追加
                Sale::create([
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price,
                ]);
            });
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => '購入処理に失敗しました。'], 500);
        }
    }
}

