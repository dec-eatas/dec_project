<?php

namespace App\Repositories\Interfaces;

use App\Models\Answer;

Interface AnswerRepositoryInterface {

    public function find(int $answer_id):Answer;

    public function getByQuestion(int $question_id):Answer;

    public function getByUser(int $user_id):Answer;

    public function store(array $data):Answer;

    public function update(int $answer_id,array $data):Answer;

    public function delete(int $answer_id);

}