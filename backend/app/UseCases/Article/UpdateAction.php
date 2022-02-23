<?php

namespace App\UseCases\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Auth;

class UpdateAction
{

    public $art_repo;

    function __construct()
    {
        $this->art_repo = new ArticleRepository;
    } 

    public function __invoke($request)
    {
        $param = $request->only(['title','content']);
        $param = array_merge(['user_id'=>Auth::id()],$param);
        $question = $this->art_repo->update(Auth::id(),$param);

        return [
            'id' => $question->id,
        ];

    }

}