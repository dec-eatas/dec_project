<?php

namespace App\UseCases\Question;
use App\Repositories\QuestionRepository;
use Illuminate\Support\Facades\Auth;

class StoreAction
{

    public $que_repo;

    function __construct()
    {
        $this->que_repo = new QuestionRepository;
    } 

    public function __invoke($request)
    {
        $param = $request->only(['title','content']);
        $param = array_merge(['user_id'=>Auth::id()],$param);
        $question = $this->que_repo->store($param);

        return [
            'id' => $question->id,
        ];

    }

}