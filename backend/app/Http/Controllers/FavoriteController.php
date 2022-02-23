<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function art_store(Article $article)
    {
        $article->users()->attach(Auth::id());//インスタンスが持ってるプロパティ arrow関数 ['id' =>$article->id])連想配列
        return redirect()->route('Art.show',['id' =>$article->id]);
    }

    function art_destroy(Article $article)
    {  
        $article->users()->detach(Auth::id());
        return redirect()->route('Art.show',['id' =>$article->id]);
    }

    public function que_store(Question $question)
    {
        $question->users()->attach(Auth::id());
        return redirect()->route('Que.show',['id' =>$question->id]);
    }

   
    function que_destroy(Question $question)
    {
        $question->users()->detach(Auth::id());
        return redirect()->route('Que.show',['id' =>$question->id]);
    }

    public function ans_store(Answer $answer)
    {
        $answer->users()->attach(Auth::id());
        return redirect()->route('Que.show',['id' =>$answer->question_id]);
    }

    function ans_destroy(Answer $answer)
    {
        $answer->users()->detach(Auth::id());
        return redirect()->route('Que.show',['id' =>$answer->question_id]);
        
    }
    
}
