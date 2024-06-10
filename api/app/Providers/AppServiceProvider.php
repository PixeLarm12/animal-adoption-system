<?php

namespace App\Providers;

use App\Repositories\AdoptionRepository;
use App\Repositories\AnimalRepository;
use App\Repositories\BaseRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\CatalogRepository;
use App\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);

        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository($app->make('App\Models\User'));
        });

        $this->app->bind(AnimalRepository::class, function ($app) {
            return new AnimalRepository($app->make('App\Models\Animal'));
        });

        $this->app->bind(AdoptionRepository::class, function ($app) {
            return new AdoptionRepository($app->make('App\Models\Adoption'));
        });

        $this->app->bind(CatalogRepository::class, function ($app) {
            return new CatalogRepository($app->make('App\Models\Catalog'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
