<?php

namespace App\UseCases\Question;
use App\Repositories\QuestionRepository;

class EditAction
{
    public $que_repo;

    function __construct()
    {
        $this->que_repo = new QuestionRepository;
    } 

    public function __invoke($request)
    {
        $param = $request->only(['id','title','content']);
        return $param;
    }
}