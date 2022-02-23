<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $faker = Faker::create('ja_JP');

        // ユーザーを50人作成
        $users = User::factory()->count(50)->create();

        foreach($users as $user) {
            // フォローを追加
            $user->follows()->attach( User::find($faker->numberBetween($min = 1, $max = 50)) );
            // フォロワーを追加
            $user->followers()->attach( User::find($faker->numberBetween($min = 1, $max = 50)) );
        }
    }
}
