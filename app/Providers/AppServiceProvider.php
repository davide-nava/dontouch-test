<?php

namespace App\Providers;

use App\Repositories\ProfileAttributeRepository;
use App\Repositories\ProfileAttributeRepositoryInterface;
use App\Repositories\ProfileRepository;
use App\Repositories\ProfileRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\ProfileAttributeService;
use App\Services\ProfileService;
use App\Services\UserService;
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
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(ProfileService::class, function ($app) {
            return new ProfileService($app->make(ProfileRepositoryInterface::class));
        });

        $this->app->bind(ProfileAttributeRepositoryInterface::class, ProfileAttributeRepository::class);
        $this->app->bind(ProfileAttributeService::class, function ($app) {
            return new ProfileAttributeService($app->make(ProfileAttributeRepositoryInterface::class));
        });

        $this->app->singleton(\Illuminate\Contracts\Routing\ResponseFactory::class, function () {
            return new \Laravel\Lumen\Http\ResponseFactory();
        });

        $this->app->extend(\Illuminate\Translation\Translator::class, function ($translator) {
            return new \App\Translation\Translator($translator->getLoader(), $translator->getLocale());
        });

    }
}
