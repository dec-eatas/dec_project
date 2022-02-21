<?php


namespace App\Repositories;

use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;

class ArticleRepository implements ArticleRepositoryInterface {


    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function find(int $article_id):Article
    {
        return Article::find($article_id);
    }

    public function getByUser(int $user_id):Article
    {
        return Article::where('user_id','=',$user_id)
            ->get();
    }

    public function store(array $data):Article
    {    
        return Article::create($data);
    }

    public function update(int $article_id,array $data):Article
    {
        return Article::find($article_id)
            ->update($data);
    }

    public function delete(int $article_id)
    {
        Article::destroy($article_id);
    }

}