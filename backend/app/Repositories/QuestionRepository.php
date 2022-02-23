<?php


namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Models\Question;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Type\Integer;

class QuestionRepository implements RepositoryInterface {

    public function all():Collection
    {
        return Question::all();
    }

    public function find(int $question_id):Question
    {
        return Question::find($question_id);
    }

    public function getByUser(int $user_id):Question
    {
        return Question::where('user_id','=',$user_id)
            ->get();
    }

    public function store(array $data):Question
    {    
        return Question::create($data);
    }

    public function update(int $question_id,array $data):Integer
    {
        return Question::find($question_id)
            ->update($data);
    }

    public function delete(int $question_id)
    {
        Question::destroy($question_id);
    }

}