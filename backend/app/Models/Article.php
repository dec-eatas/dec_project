<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    //以下はarticle モデルは  userモデルと多対多の連携をすることを示す
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
