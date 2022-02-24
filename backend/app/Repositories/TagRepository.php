<?php


namespace App\Repositories;

use App\Models\Tag;
use App\Models\QuestionTag;
use App\Models\ArticleTag;
use Illuminate\Support\Facades\DB;

class TagRepository{

    public static function get_trend()
    {

        $que_tags = QuestionTag::join('tags','question_tags.tag_id','=','tags.id')
            ->select('tags.id','tags.name',DB::raw("count(question_tags.tag_id) as cnt"))
            ->groupBy('question_tags.tag_id')
            ->orderBy('cnt','DESC')
            ->limit(5)->get()->toArray();

        
        $art_tags = ArticleTag::join('tags','article_tags.tag_id','=','tags.id')
            ->select('tags.id','tags.name',DB::raw("count(article_tags.tag_id) as cnt"))
            ->groupBy('article_tags.tag_id')
            ->orderBy('cnt','DESC')
            ->limit(5)->get()->toArray();

        return [
            'que_tags' => $que_tags,
            'art_tags' => $art_tags
        ];

    }

}