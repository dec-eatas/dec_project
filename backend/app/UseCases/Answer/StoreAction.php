<?php

namespace App\UseCases\Answer;
use App\Repositories\AnswerRepository;
use Illuminate\Support\Facades\Auth;

class StoreAction
{

    public $ans_repo;

    function __construct()
    {
        $this->ans_repo = new AnswerRepository;
    } 

    public function __invoke($request)
    {
        $param = $request->only(['question_id','content']);
        $param = array_merge(['user_id'=>Auth::id()],$param);

        $answer = $this->ans_repo->store($param);

        return [
            'id' => $param['question_id'],
        ];
    }

}