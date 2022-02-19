<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Auth;

class FavoriteController extends Controller
{
    public function store(Article $article)
    {
        $article->users()->attach(Auth::id());
        return redirect()->route('article.index');
    }

   
    function destroy(Article $article)
    {
        $article->users()->detach(Auth::id());
        return redirect()->route('article.index');
    }
}
