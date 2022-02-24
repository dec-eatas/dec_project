<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Collection;
use Ramsey\Uuid\Type\Integer;

class ArticleRepository implements RepositoryInterface {

    public function all()
    {
        $articles = Article::join('users','articles.user_id','=','users.id')
        ->join('categories','articles.category_id','categories.id')
        ->select('articles.*','users.name as user_name','categories.name as category_name')
        ->get();

        $tags = [];

        foreach($articles as $article){
            $tag = ArticleTag::join('tags','article_tags.tag_id','=','tags.id')
                ->select('article_tags.tag_id','tags.name as tag_name')
                ->where('article_tags.article_id','=',$article->id)
                ->get();

            $tags[count($tags)] = $tag->toArray();
        }

        return [
            'model' => $articles,
            'tags' => $tags
        ];
    }

    public function find(int $article_id):array
    {

        $article = Article::join('users','articles.user_id','=','users.id')
            ->join('categories','articles.category_id','categories.id')
            ->select('articles.*','users.name as user_name','categories.name as category_name')
            ->where('articles.id','=',$article_id)
            ->first();

        $tags = ArticleTag::join('tags','article_tags.tag_id','=','tags.id')
            ->select('article_tags.tag_id','tags.name as tag_name')
            ->where('article_tags.article_id','=',$article_id)
            ->get();

        return [
            'model' => $article,
            'tags' => $tags
        ];
    }

    public function getByUser(int $user_id):array
    {
        $articles = Article::join('users','articles.user_id','=','users.id')
        ->join('categories','articles.category_id','categories.id')
        ->select('articles.*','users.name as user_name','categories.name as category_name')
        ->where('articles.user_id','=',$user_id)
        ->get();

        $tags = [];

        foreach($articles as $article){
            $tag = ArticleTag::join('tags','article_tags.tag_id','=','tags.id')
                ->select('article_tags.tag_id','tags.name as tag_name')
                ->where('article_tags.article_id','=',$article->id)
                ->get();

            $tags[count($tags)] = $tag->toArray();
        }

        return [
            'model' => $articles,
            'tags' => $tags
        ];
    }

    public function searchByTitle(String $keyword):array
    {
        $articles = Article::join('users','articles.user_id','=','users.id')
            ->join('categories','articles.category_id','categories.id')
            ->select('articles.*','users.name as user_name','categories.name as category_name')
            ->where('title', 'LIKE', '%'.$keyword.'%')
            ->orderBy('updated_at', 'DESC')
            ->get();

        $tags = [];

        foreach($articles as $question){
            $tag = ArticleTag::join('tags','article_tags.tag_id','=','tags.id')
                ->select('article_tags.tag_id','tags.name as tag_name')
                ->where('article_tags.article_id','=',$question->id)
                ->get();
            $tags[count($tags)] = [
                'article_id' => $question->id,
                'tags' => $tag->toArray()
            ];
        }

        return [
            'model' => $articles,
            'tags' => $tags
        ];
    }

    // public function searchByTag(String $keyword):array
    // {
    //     $tags = Tag::select('id')
    //     ->where('name','LIKE',$keyword)
    //     ->get();
    // }

    public function hyperSearch(array $search_material):array
    {

        $article_tags = [];

        foreach($search_material['tags'] as $tag){
            $tags = Tag::select('id')
                ->where('name','LIKE',$tag)
                ->get();
            
            foreach($tags as $tag){
                $article_tags[count($article_tags)] = $tag->id;
            }
        }

        $article_tag = ArticleTag::select('article_id')
            ->whereIn('tag_id',$article_tags)
            ->groupBy('article_id')
            ->get()->toArray();

        $article_ids = [];

        foreach($article_tag as $tag_id){
            $article_ids[count($article_ids)] = $tag_id['article_id'];
        }

        $articles = Article::join('users','articles.user_id','=','users.id')
            ->join('categories','articles.category_id','categories.id')
            ->select('articles.*','users.name as user_name','categories.name as category_name')
            ->whereIn('articles.id',$article_ids)
            ->whereIn('articles.category_id',$search_material['category_id'])
            ->orderBy('articles.updated_at', 'DESC')
            ->get();

        $tags = [];

        foreach($articles as $article){
            $tag = ArticleTag::join('tags','article_tags.tag_id','=','tags.id')
                ->select('article_tags.tag_id','tags.name as tag_name')
                ->where('article_tags.article_id','=',$article->id)
                ->get();
            $tags[count($tags)] = $tag->toArray();
        }

        return [
            'model' => $articles,
            'tags' => $tags
        ];
    }


    public function store(array $data):Article
    {    

        return DB::transaction(function() use($data){

            $article = Article::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'user_id' => Auth::id(),
                'category_id' => $data['category_id'],
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
                        }else{
                            throw new Exception ;
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