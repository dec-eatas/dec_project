<?php

namespace App\UseCases\Question;
use App\Repositories\QuestionRepository;
use App\Repositories\AnswerRepository;
use App\Services\ListService;

class ShowAction{

    public $que_repo;
    public $ans_repo;

    function __construct()
    {
        $this->que_repo = new QuestionRepository;
        $this->ans_repo = new AnswerRepository;
    } 

    public function __invoke($request)
    {
        $id = $request->route('id');
        $question = $this->que_repo->find($id);
        $answers  = $this->ans_repo->getByQuestion($id);
        $que_list = ListService::shape_show($question);
        $ans_list = ListService::shape_answers($answers);

        
        $favorites = [
            'parent' => [
                'model' => $question['model'],
                'route' => 'que',
            ],
            'child' => [
                'model' => $answers,
                'route' => 'ans', 
            ]
        ];

        return [
            'que_list' => $que_list,
            'ans_list' => $ans_list,
            'favorites' => $favorites,
            'i' => 0,
            'ans_confirm' => $request->route('tentative'),
            'trend' => $request->session()->get('trend'),
        ];
    }
}