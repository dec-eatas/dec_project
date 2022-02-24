<?php

namespace App\UseCases\Account;
use App\Repositories\ArticleRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\AnswerRepository;
use App\Services\ListService;
use Illuminate\Support\Facades\Auth;

class IndexAction
{

    public $art_repo;

    function __construct()
    {
        $this->que_repo = new QuestionRepository;
        $this->art_repo = new ArticleRepository;
        $this->ans_repo = new AnswerRepository;
    } 

    public function __invoke($request)
    {
        $question = $this->que_repo->getByUser(Auth::id());
        $article = $this->art_repo->getByUser(Auth::id());
        
        $que_list = ListService::shape_primitive($question,'Que.show',['id'=>'id'],'Que.tag_search');
        $art_list = ListService::shape_primitive($article,'Art.show',['id'=>'id'],'Art.tag_search');
      
        $list = [
            'que' => $que_list,
            'art' => $art_list
        ];

        $fusion = ListService::fusion_list($list);

        return [
            'acc_list' => $fusion,
            'trend' => $request->session()->get('trend'),
            'user' => Auth::user()
        ];

    }
}