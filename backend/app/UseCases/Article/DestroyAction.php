<?php

namespace App\UseCases\Article;
use App\Repositories\ArticleRepository;

class DestroyAction
{

    public $artrepo;

    function __construct()
    {
        $this->artrepo = new ArticleRepository;
    } 

    public function __invoke($request)
    {
        $this->artrepo->delete($request->input('id'));
    }

}