<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    use HasFactory;
    protected $guarded  = ['created_at','updated_at'];

    
    public function questions()
    {
        return $this->belongsToMany(Tag::class);
    }
}
