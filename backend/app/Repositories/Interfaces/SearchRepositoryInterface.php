<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

Interface SearchRepositoryInterface {

    public function getByKeyword(String $keyword):Collection;

    public function getByCategory(int $category_id):Collection;

    public function getByTag(String $tag):Collection;

}