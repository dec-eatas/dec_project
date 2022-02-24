<?php

namespace App\UseCases\Question;
use App\Repositories\CategoryRepository;
use App\Services\ListService;

class CreateAction
{

    public $cate_repo;

    function __construct()
    {
        $this->cate_repo = new CategoryRepository;
    } 

    public function __invoke()
    {
        
        $category = ListService::category_opt($this->cate_repo->all());
        $tag = [
            'l_name' => 'タグ',
            'p_name' => 'tags[]',
            'type' => 'text',
            'confirm' => ''
        ];

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
                'options' => $category
            ],
            $tag,$tag,$tag,$tag,$tag,
            [
                'l_name' => '本文',
                'p_name' => 'content',
                'type' => 'textarea',
                'confirm' => ''
            ],
        ];

        return [
            'forms' => $forms,
            'route' => 'Que.store',
            'create_title' => '質問'
        ];

    }

}