<?php

namespace App\UseCases\Question;
use App\Repositories\QuestionRepository;

class DestroyAction
{

    public $que_repo;

    function __construct()
    {
        $this->que_repo = new QuestionRepository;
    } 

    public function __invoke($request)
    {
        $this->que_repo->delete($request->input('id'));
    }

}