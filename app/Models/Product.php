<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model{
    use HasFactory;

    protected $fillable = [
        'name', 'maker', 'price', 'stock', 'comment','image_path'];
}

