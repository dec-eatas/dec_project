<?php

namespace App\Repositories\Interfaces;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Integer;

Interface RepositoryInterface {

    public function all();

    public function find(int $question_id):array;

    public function store(array $data):Model;

    public function update(int $question_id,array $data):Integer;

    public function delete(int $question_id);

}