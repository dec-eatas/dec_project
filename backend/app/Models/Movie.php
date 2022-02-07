<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
        'title',
    ]; //保存したいカラム名が複数の場合
    protected $guaded = 'id';

}
