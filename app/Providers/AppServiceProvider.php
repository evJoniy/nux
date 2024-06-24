<?php

namespace App\Providers;

use App\Repositories\HistoryRepository;
use App\Repositories\Interfaces\HistoryRepositoryInterface;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\LinkRepository;
use App\Repositories\UserRepository;
use App\Services\HistoryService;
use App\Services\Interfaces\HistoryServiceInterface;
use App\Services\Interfaces\LinkServiceInterface;
use App\Services\Interfaces\LuckyServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\LinkService;
use App\Services\LuckyService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(HistoryServiceInterface::class, HistoryService::class);
        $this->app->singleton(LinkServiceInterface::class, LinkService::class);
        $this->app->singleton(LuckyServiceInterface::class, LuckyService::class);
        $this->app->singleton(UserServiceInterface::class, UserService::class);

        $this->app->singleton(HistoryRepositoryInterface::class, HistoryRepository::class);
        $this->app->singleton(LinkRepositoryInterface::class, LinkRepository::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        //or explode to "domain" providers
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
