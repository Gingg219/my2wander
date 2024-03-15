<?php

namespace App\Providers;

use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\TagRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Eloquent\CategoryRepositoryEloquent;
use App\Repositories\Eloquent\PostRepositoryEloquent;
use App\Repositories\Eloquent\TagRepositoryEloquent;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(PostRepository::class, PostRepositoryEloquent::class);
        $this->app->bind(TagRepository::class, TagRepositoryEloquent::class);
        $this->app->bind(CategoryRepository::class, CategoryRepositoryEloquent::class);
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
