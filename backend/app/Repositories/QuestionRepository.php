<?php


namespace App\Repositories;

use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Models\Question;

class QuestionRepository implements QuestionRepositoryInterface {


    public function __construct(Question $question)
    {
        $this->question = $question;
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

    public function update(int $question_id,array $data):Question
    {
        return Question::find($question_id)
            ->update($data);
    }

    public function delete(int $question_id)
    {
        Question::destroy($question_id);
    }

}