<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'ダイエット'
            ],
            [
                'name' => '美容'
            ],
            [
                'name' => '老化予防、若々しさの維持'
            ],
            [
                'name' => '体力の維持、向上'
            ],
            [
                'name' => '筋肉などの肉体づくり'
            ],
            [
                'name' => '疲労の回復、病気予防'
            ],
            [
                'name' => '病気の予防、改善'
            ],
            [
                'name' => 'レシピ'
            ],
            [
                'name' => 'その他'
            ]
        ]);
    }
}
