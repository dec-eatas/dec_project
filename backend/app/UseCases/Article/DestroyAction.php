<?php

namespace App\UseCases\Article;
use App\Repositories\ArticleRepository;

class DestroyAction
{

    public $art_repo;

    function __construct()
    {
        $this->art_repo = new ArticleRepository;
    } 

    public function __invoke($request)
    {
        $this->artrepo->delete($request->input('id'));
    }

}