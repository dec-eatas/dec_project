<?php

namespace App\UseCases\Question;
use App\Repositories\QuestionRepository;
use App\Services\ListService;

class SearchTitleAction
{

    public $que_repo;

    function __construct()
    {
        $this->que_repo = new QuestionRepository;
    } 

    public function __invoke($request)
    {
        $keyword = $request->input('keyword');
        //取ってきたデータを一時保存
        $question = $this->que_repo->searchByTitle($keyword);
        $que_list = ListService::shape_index($question,'Que.show',['id'=>'id'],'Que.tag_search');

        return [
            'que_list' => $que_list,
            'search_route' => 'Que.search',
            'create_route' => 'Que.create',
            'trend' => $request->session()->get('trend'),
        ];
    }
}