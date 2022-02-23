<?php

namespace App\UseCases\Article;
use App\Repositories\ArticleRepository;

class EditAction
{

    public $art_repo;

    function __construct()
    {
        $this->art_repo = new ArticleRepository;
    } 

    public function __invoke($request)
    {
        $param = $request->only(['id','title','content']);
        return $param;
    }

}