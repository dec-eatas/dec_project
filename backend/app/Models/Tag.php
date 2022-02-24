<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $guarded  = ['id'];

    public function question_tags()
    {
        return $this->hasMany(QuestionTag::class);
    }

    public function article_tags()
    {
        return $this->hasMany(ArticleTag::class);
    }


}
