<?php

namespace App\Providers;

use App\Interfaces\Kamban\BoardRepositoryInterface;
use App\Interfaces\Kamban\ColumnRepositoryInterface;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;
use App\Interfaces\TaskRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\Kamban\BoardRepository;
use App\Repositories\Kamban\ColumnRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\TagRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

// Kamban

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);

        // Kamban
        $this->app->bind(BoardRepositoryInterface::class, BoardRepository::class);
        $this->app->bind(ColumnRepositoryInterface::class, ColumnRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
