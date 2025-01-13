<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Disease;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::paginate(10);
        $diseases = Disease::all();
        return view('article.index', compact('articles', 'diseases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $diseases = Disease::all();
        return view('article.create', compact('diseases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'disease_id' => 'required',
            'title' => 'required',
            'title_hindi' => 'required',
            'url' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $article = new Article();
        $article->disease_id = $request->disease_id;
        $article->title = $request->title;
        $article->title_hindi = $request->title_hindi;
        $article->url = $request->url;
        if ($request->thumbnail) {
            $article->thumbnail = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('images/articles'), $article->thumbnail);
        }
        $article->save();

        return redirect()->route('article.index')->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $diseases = Disease::all();
        $article = Article::find($id);
        return view('article.edit', compact('article', 'diseases'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'disease_id' => 'required',
            'title' => 'required',
            'title_hindi' => 'required',
            'url' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $article = Article::find($id);
        $article->disease_id = $request->disease_id;
        $article->title = $request->title;
        $article->title_hindi = $request->title_hindi;
        $article->url = $request->url;
        if ($request->thumbnail) {
            if ($article->thumbnail && file_exists(public_path('images/articles/' . $article->thumbnail))) {
                unlink(public_path('images/articles/' . $article->thumbnail));
            }
            $article->thumbnail = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('images/articles'), $article->thumbnail);
        }
        $article->save();

        return redirect()->route('article.index')->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('article.index')->with('success', 'Article deleted successfully.');
    }
}
