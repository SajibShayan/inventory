<?php

namespace App\Providers;

use App\Contract\Repositories\InventoryRepositoryInterface;
use App\Contract\Repositories\ItemRepositoryInterface;
use App\Contract\Repositories\TaskRepositoryInterface;
use App\Contract\Repositories\UserRepositoryInterface;
use App\Repositories\InventoryRepository;
use App\Repositories\ItemRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(InventoryRepositoryInterface::class, InventoryRepository::class);
        $this->app->bind(ItemRepositoryInterface::class, ItemRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
