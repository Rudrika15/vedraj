<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use App\Models\Product;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index($id = 0)
    {
        $language = Auth::user()->language;

        $diseaseHindiField = ['diseaseProducts.diseases:*,disease_name_hindi as display_name,description_hindi as display_description'];
        $diseaseEngField = ['diseaseProducts.diseases:*,disease_name as display_name,description as display_description'];

        $productHindiField = ['*', 'product_name_hindi as display_name', 'description_hindi as display_description'];
        $productEngField = ['*', 'product_name as display_name', 'description as display_description'];

        if ($language == 'hi') {
            $products = Product::with($diseaseHindiField)->select($productHindiField);
        } else {
            $products = Product::with($diseaseEngField)->select($productEngField);
        }


        if ($id != 0) {
            $products->where('id', $id);
        }
        $currentPage = request()->get('current_page', 1);

        $currentPage = max((int) $currentPage, 1);
        $perPage = request()->get('per_page') ? request()->get('per_page') : PHP_INT_MAX;
        $products = $products->orderBy('id', 'desc')->paginate($perPage, ['*'], 'page', $currentPage);
        return Util::getSuccessMessage('Disease Wise Product List', $products);
    }
}
