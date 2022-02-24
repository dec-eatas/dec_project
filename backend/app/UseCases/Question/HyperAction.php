<?php

namespace App\UseCases\Question;
use App\Repositories\QuestionRepository;
use App\Services\ListService;
use App\Services\FormService;

class HyperAction
{

    public $art_repo;

    function __construct()
    {
        $this->que_repo = new QuestionRepository;
    } 

    public function __invoke($request)
    {
        $param = $request->onry(['category_id','keyword']);
        $search_material = FormService::sharp_search($param);
        $question = $this->que_repo->hyperSearch($search_material);
        $que_list = ListService::shape_index($question,'Que.show',['id'=>'id'],'Que.tag_search');

        return [
            'que_list' => $que_list,
            'keyword' => $param['keyword'],
            'trend' => $request->session()->get('trend'),
        ];
    }
}