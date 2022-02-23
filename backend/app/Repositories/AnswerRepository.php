<?php


namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;

use App\Models\Answer;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Type\Integer;

class AnswerRepository implements RepositoryInterface , PostRepositoryInterface{


    public function all():Collection
    {
        return Answer::all();
    }

    public function find(int $answer_id):Answer
    {
        return Answer::find($answer_id);
    }

    public function getByQuestion(int $question_id):Collection
    {
        return Answer::join('users','user_id','=','users.id')
            ->select('answers.*','users.name as user_name')
            ->where('answers.question_id','=',$question_id)
            ->orderBy('updated_at','DESC')
            ->get();
    }

    public function getByUser(int $user_id):Collection
    {
        return Answer::where('user_id','=',$user_id)
            ->get();
    }

    public function store(array $data):Answer
    {    
        return Answer::create($data);
    }

    public function update(int $answer_id,array $data):Integer
    {
        return Answer::find($answer_id)
            ->update($data);
    }

    public function delete(int $answer_id)
    {
        Answer::destroy($answer_id);
    }

}