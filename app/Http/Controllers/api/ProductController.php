<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use App\Models\Product;
use App\Utils\Util;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return  $diseases = Disease::with('products')->get();
        return Util::getSuccessMessage('Disease Wise Product List', $diseases);
    }
}
