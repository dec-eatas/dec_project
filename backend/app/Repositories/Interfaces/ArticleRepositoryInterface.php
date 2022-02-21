<?php

namespace App\Repositories\Interfaces;

use App\Models\Article;

Interface ArticleRepositoryInterface {

    public function find(int $article_id):Article;

    public function getByUser(int $user_id):Article;

    public function store(array $data):Article;

    public function update(int $article_id,array $data):Article;

    public function delete(int $article_id);

}