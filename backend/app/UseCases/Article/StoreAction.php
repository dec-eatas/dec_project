<?php

namespace App\UseCases\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Auth;

class StoreAction
{

    public $art_repo;

    function __construct()
    {
        $this->art_repo = new ArticleRepository;
    } 

    public function __invoke($request)
    {

        $param = $request->only(['title','content','tags','category_id']);
        $param = array_merge(['user_id'=>Auth::id()],$param);
        $article = $this->art_repo->store($param);

        return [
            'id' => $article->id,
        ];

    }

}