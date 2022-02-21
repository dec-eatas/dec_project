<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\AnswerRepositoryInterface;
use App\Repositories\AnswerRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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
