<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_exampleテスト()
    {
        $cnt = 12;
        for($i=0; $i<$cnt; $i++){
            Movie::insert([
                'title' => 'タイトル'.$i,
                'image_url' => 'https://readouble.com/laravel/8.x/ja/validation.html',
            ]);
        }
        
        $movies = app()->make('movies');
        $response = $this->get('/');

        $response->assertStatus(200);
    
        foreach($movies as $movie){
            $response->assertSeeText($movie->title);
            $response->assertSee($movie->image_url);
        }
    }
}
