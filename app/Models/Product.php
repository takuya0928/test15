<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model{
    use HasFactory;

    protected $fillable = [
        'name', 'maker', 'price', 'stock', 'comment','image_path'];

        // 商品一覧取得
        public static function getAllProducts()
        {
            return self::orderBy('id', 'asc')->get();
        }
        // 商品登録
        public static function storeProduct($data)
        {
            return self::create($data);
        }
        // 商品更新
        public static function updateProduct($id,$data)
        {
            $product = self::findOrFail($id);
            $product->update($data);
            return $product;
        }
        // 商品削除
        public static function deleteProduct($id)
        {
            $product = self::findOrFail($id);
            return $product->delete();
        }
        }