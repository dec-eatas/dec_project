<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

Interface PostRepositoryInterface {

    public function getByUser(int $user_id):Collection;

}