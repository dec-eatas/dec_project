<?php

namespace App\Repositories\Interfaces;

use App\Models\Question;

Interface QuestionRepositoryInterface {

    public function find(int $question_id):Question;

    public function getByUser(int $user_id):Question;

    public function store(array $data):Question;

    public function update(int $question_id,array $data):Question;

    public function delete(int $question_id);

}