<?php

namespace App\UseCases\Article;
use App\Repositories\ArticleRepository;
use App\Services\ListService;

class ShowAction{

    public $art_repo;

    function __construct()
    {
        $this->art_repo = new ArticleRepository;;
    } 

    public function __invoke($request)
    {

        $id = $request->route('id');
        $article = $this->art_repo->find($id);
        $art_list = ListService::shape_show($article);
        $favorites = [
            'parent' => [
                'model' => $article,
                'route' => 'art',
            ],
        ];


        return [
            'art_list' => $art_list,
            'favorites' => $favorites,
        ];
    }
}