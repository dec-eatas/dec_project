<?php

namespace App\UseCases\Article;
use App\Repositories\ArticleRepository;
use App\Services\ListService;

class SearchTitleAction
{

    public $art_repo;

    function __construct()
    {
        $this->art_repo = new ArticleRepository;
    } 

    public function __invoke($request)
    {

        $keyword = $request->input('keyword');
        
        //取ってきたデータを一時保存
        $article = $this->art_repo->searchByTitle($keyword);
        $search_route ='Art.search';//Que.searchが動く
        
        $art_list = ListService::shape_index($article,'Art.show',['id'=>'id']);

        return [
            'art_list' => $art_list,
            'search_route' => $search_route
        ];

    }

}