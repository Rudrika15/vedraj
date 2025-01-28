<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Disease;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index($disease_id = 0)
    {
        $language = Auth::user()->language;

        $diseaseHindiField = ['disease:*,disease_name_hindi as display_name,description_hindi as display_description'];
        $diseaseEngField = ['disease:*,disease_name as display_name,description as display_description'];

        $articalHindiField = ['*', 'title_hindi as display_name'];
        $articalEngField = ['*', 'title as display_name'];

        if ($language == 'hi') {
            $article = Article::with($diseaseHindiField)->select($articalHindiField);
        } else {
            $article = Article::with($diseaseEngField)->select($articalEngField);
        }

        if ($disease_id != 0) {
            $article->where('disease_id', $disease_id);
        }
        $article = $article->orderBy('id', 'desc')->paginate(10);

        return Util::getSuccessMessage('Disease Wise Article List', $article);
    }
}
