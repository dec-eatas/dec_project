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

    public function __invoke()
    {

        $art_list = ListService::shape_index($this->art_repo->all(),'Art.show',['id'=>'id']);

        return [
            'art_list' => $art_list,
            'search_route' => 'Art.search',
            'create_route' => 'Art.create'
        ];

    }

}