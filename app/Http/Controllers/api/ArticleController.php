<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use App\Utils\Util;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $article = Disease::with('articles')->get();
        return Util::getSuccessMessage('Disease Wise Article List', $article);
    }
}
