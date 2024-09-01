<?php

namespace App\Providers;

use App\Services\Implementation\ProjectService;
use App\Services\Implementation\TaskService;
use App\Services\ProjectServiceInterface;
use App\Services\TaskServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceBindingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Binding the TaskServiceInterface to TaskService
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
        // Similarly, you can bind other services
        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
