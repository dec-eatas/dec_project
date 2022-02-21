<?php


namespace App\Repositories;

use App\Repositories\Interfaces\AnswerRepositoryInterface;
use App\Models\Answer;

class AnswerRepository implements AnswerRepositoryInterface {


    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function find(int $answer_id):Answer
    {
        return Answer::find($answer_id);
    }

    public function getByQuestion(int $question_id):Answer
    {
        return Answer::where('question_id','=',$question_id)
            ->get();
    }

    public function getByUser(int $user_id):Answer
    {
        return Answer::where('user_id','=',$user_id)
            ->get();
    }

    public function store(array $data):Answer
    {    
        return Answer::create($data);
    }

    public function update(int $answer_id,array $data):Answer
    {
        return Answer::find($answer_id)
            ->update($data);
    }

    public function delete(int $answer_id)
    {
        Answer::destroy($answer_id);
    }

}