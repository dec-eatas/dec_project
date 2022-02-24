<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\AnswerRepositoryInterface;
use App\Repositories\AnswerRepository;
use App\Models\Question;
use App\Models\Answer;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('QuestionRepository',Question::class);

        app()->bind('AnswerRepository',Answer::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(QuestionRepositoryInterface::class,QuestionRepository::class);
        $this->app->bind(AnswerRepositoryInterface::class,AnswerRepository::class);
        $this->app->bind(ArticleRepositoryInterface::class,ArticleRepository::class);
    }
}
