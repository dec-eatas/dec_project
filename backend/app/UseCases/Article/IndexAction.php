<?php

namespace App\UseCases\Article;
use App\Repositories\ArticleRepository;
use App\Services\ListService;

class IndexAction
{

    public $art_repo;

    function __construct()
    {
        $this->art_repo = new ArticleRepository;
    } 

    public function __invoke($request)
    {

        $art_list = ListService::shape_index($this->art_repo->all(),'Art.show',['id'=>'id'],'Art.tag_search');

        return [
            'art_list' => $art_list,
            'search_route' => 'Art.search',
            'create_route' => 'Art.create',
            'trend' => $request->session()->get('trend'),
        ];

    }

}