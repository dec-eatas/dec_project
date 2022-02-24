<?php

namespace App\UseCases\Question;
use App\Repositories\QuestionRepository;
use App\Services\ListService;

class IndexAction
{

    public $que_repo;

    function __construct()
    {
        $this->que_repo = new QuestionRepository;
    } 

    public function __invoke()
    {
        $que_list = ListService::shape_index($this->que_repo->all(),'Que.show',['id'=>'id']);
        $search_route ='Que.search';//Que.searchが動く
        
        return [
            'que_list' => $que_list,
            'search_route' => $search_route
        ];

    }

}