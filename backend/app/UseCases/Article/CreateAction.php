<?php

namespace App\UseCases\Article;
use App\Repositories\ArticleRepository;
use App\Services\ListService;

class CreateAction
{

    public $art_repo;

    function __construct()
    {
        $this->art_repo = new ArticleRepository;
    } 

    public function __invoke()
    {

        $create_form = ListService::create_form($this->art_repo->all(),'Art.show',['id'=>'id']);


        $forms = [
            [
                'l_name' => 'タイトル',
                'p_name' => 'title',
                'type' => 'text',
                'confirm' => ''
            ],
            [
                'l_name' => 'カテゴリ',
                'p_name' => 'category_id',
                'type' => 'select',
                'options' => [
                    [
                        'value' => '1',
                        'l_name' => 'カテゴリ名'
                    ],
                ]
            ],
            [
                'l_name' => 'タグ',
                'p_name' => 'tags[]',
                'type' => 'text',
                'confirm' => ''
            ],
            [
                'l_name' => '本文',
                'p_name' => 'content',
                'type' => 'textarea',
                'confirm' => ''
            ],
        ];

        return [
            'forms' => $forms,
            'route' => 'Art.store'
        ];

    }

}