<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Collection;
use Ramsey\Uuid\Type\Integer;

class ArticleRepository implements RepositoryInterface {

    public function all():Collection
    {
        return Article::all();
    }

    public function find(int $article_id):array
    {

        $article = Article::join('users','article.user_id','=','users.id')
            ->select('article.*','users.name as user_name')
            ->where('article.id','=',$article_id)
            ->first();

        $tags = ArticleTag::join('tags','article_tags.tag_id','=','tags.id')
            ->select('article_tags.*','tags.name as tag_name')
            ->where('article_tags.article_id','=',$article_id)
            ->get();

        return [
            'article' => $article,
            'tags' => $tags
        ];
    }

    public function getByUser(int $user_id):Collection
    {
        return Article::where('user_id','=',$user_id)
            ->get();
    }

    public function searchByTitle(String $keyword):Collection
    {
       return Article::where('title', 'LIKE', '%'.$keyword.'%')
            ->orderBy('updated_at', 'DESC')
            ->get();
    }


    public function store(array $data):Article
    {    

        return DB::transaction(function() use($data){

            $article = Article::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'user_id' => Auth::id()
            ]);

            $tags = [];

            foreach($data['tags'] as $tag){
                if(mb_strlen($tag) > 0){
                    try{
                        $tags[count($tags)] = Tag::create([
                            'name' => $tag
                        ]); 
                    }catch(QueryException $e){
                        $error_code = $e->errorInfo[1];
                        
                        if($error_code == 1062){
                            $tags[count($tags)] = Tag::where('name','=',$tag)->first();
                        }
                    }
                }
            }

            $article_tags = [];

            for($i=0; $i<count($tags); $i++){
                $article_tags[$i] = ArticleTag::create([
                    'article_id' => $article->id,
                    'tag_id' => $tags[$i]->id
                ]);
            }

            return $article;

        });

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