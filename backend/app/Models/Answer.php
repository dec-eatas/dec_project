<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answers';
    
    protected $guarded  = ['id','created_at','updated_at'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
