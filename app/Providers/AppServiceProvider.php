<?php

namespace App\Providers;

use App\Repositories\Contracts\CsvRepositoryInterface;
use App\Repositories\CsvRepository;
use App\Services\Contracts\CsvProcessorInterface;
use App\Services\CsvProcessor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CsvProcessorInterface::class, CsvProcessor::class);
        $this->app->bind(CsvRepositoryInterface::class, CsvRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
