<?php

namespace App\UseCases\Answer;
use App\Repositories\AnswerRepository;

class BackAction{

    public $ans_repo;

    function __construct()
    {
        $this->ans_repo = new AnswerRepository;
    } 


    public function __invoke($request)
    {

        $param = $request->only(['question_id','content']);

        return [
            'id' => $param['question_id'],
            'tentative' => $param['content'],
        ];

    }

}