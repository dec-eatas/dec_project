<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answers';
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function get_que_answers($question_id)
    {

        $answers = Answer::join('users','user_id','=','users.id')
            ->select('answers.*','users.name as user_name')
            ->where('answers.question_id','=',$question_id)
            ->orderBy('updated_at','DESC')
            ->get();

        return $answers;

    }

}
