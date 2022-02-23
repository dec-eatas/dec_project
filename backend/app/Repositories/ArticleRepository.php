<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Models\Article;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Type\Integer;

class ArticleRepository implements RepositoryInterface {

    public function all():Collection
    {
        return Article::all();
    }

    public function find(int $article_id):Article
    {
        return Article::find($article_id);
    }

    public function getByUser(int $user_id):Collection
    {
        return Article::where('user_id','=',$user_id)
            ->get();
    }

    public function store(array $data):Article
    {    
        return Article::create($data);
    }

    public function update(int $article_id,array $data):Integer
    {
        return Article::find($article_id)
            ->update($data);
    }

    public function delete(int $article_id)
    {
        Article::destroy($article_id);
    }

}