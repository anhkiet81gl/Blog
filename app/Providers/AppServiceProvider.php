<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\PostRepositoryInterface::class,
            \App\Repositories\PostRepository::class
        );
        $this->app->bind(
            \App\Repositories\PostCategoriesRepositoryInterface::class,
            \App\Repositories\PostCategoriesRepository::class
        );
        $this->app->bind(
            \App\Repositories\PostTagsRepositoryInterface::class,
            \App\Repositories\PostTagsRepository::class
        );
        $this->app->bind(
            \App\Repositories\PostAuthorRepositoryInterface::class,
            \App\Repositories\PostAuthorRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
