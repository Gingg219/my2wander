<?php

namespace App\Providers;

use App\Services\Api\CategoryService;
use App\Services\Api\PostService;
use App\Services\Api\TagService;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\PostServiceInterface;
use App\Services\Contracts\TagServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
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
        $this->app->bind(PostServiceInterface::class, PostService::class);
        $this->app->bind(TagServiceInterface::class, TagService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
    }
}
