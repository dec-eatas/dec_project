<?php

namespace App\UseCases\Answer;
use App\Repositories\QuestionRepository;
use App\Services\ListService;
use App\Services\FormService;

class ConfirmAction{

    public $que_repo;

    function __construct()
    {
        $this->que_repo = new QuestionRepository;
    } 


    public function __invoke($request)
    {
        
        $que_list = $request->only(['question_id','title','content','updated_at','diff']);
        $param = $request->only(['question_id','ans_confirm']);
        $question = $this->que_repo->find($param['question_id']);
        $que_list = ListService::shape_show($question);
        $confirms = FormService::get_confirm($param,['質問id','回答内容'],'01',['ans_confirm'=>'content']);

        return [
            'question' => $question['model'],
            'que_list' => $que_list,
            'confirms' => $confirms,
        ];

    }

}