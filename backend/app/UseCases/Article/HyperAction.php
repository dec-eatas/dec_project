<?php

namespace App\UseCases\Article;
use App\Repositories\ArticleRepository;
use App\Services\ListService;
use App\Services\FormService;

class HyperAction
{

    public $art_repo;

    function __construct()
    {
        $this->art_repo = new ArticleRepository;
    } 

    public function __invoke($request)
    {
    
        $param = $request->only(['category_id','keyword','mode']);
        $search_material = FormService::sharp_search($param);
        $article = $this->art_repo->hyperSearch($search_material);

        $art_list = ListService::shape_index($article,'Art.show',['id'=>'id'],'Art.tag_search');
    
        return [
            'art_list' => $art_list,
            'keyword' => $param['keyword'],
            'trend' => $request->session()->get('trend'),
        ];
    }
}