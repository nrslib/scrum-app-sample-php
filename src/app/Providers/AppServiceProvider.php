<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Scrum\Application\Service\BackLog\BackLogApplicationService;
use Scrum\Application\Service\BackLog\Query\BackLogQueryServiceInterface;
use Scrum\Domain\Models\UserStories\UserStoryRepositoryInterface;
use Scrum\EloquentInfrastructure\Persistence\UserStories\EloquentUserStoryRepository;
use Scrum\EloquentInfrastructure\QueryServices\EloquentBackLogQueryService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Applications
        $this->app->bind(BackLogApplicationService::class);

        // Infrastructures
        $this->app->bind(BackLogQueryServiceInterface::class, EloquentBackLogQueryService::class);
        $this->app->bind(UserStoryRepositoryInterface::class, EloquentUserStoryRepository::class);
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
