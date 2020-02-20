<?php

namespace App\Providers;

use App\Classes\Stats\Stats;
use App\Services\Stats\Sport\Baseball;
use App\Services\Stats\Sport\Football;
use App\Services\Stats\Sport\IceHockey;
use App\Services\Stats\Sport\Soccer;
use App\Services\Stats\Sport\Basketball;
use App\Services\Stats\Sport\Softball;
use Illuminate\Support\ServiceProvider;

class StatsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->provides() as $provide) {
            $this->app->singleton($provide, function () use ($provide) {
                return new $provide;
            });
        }
    }

    /**
     * Return an array of provides services.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            Stats::class,
            IceHockey::class,
            Baseball::class,
            Softball::class,
            Soccer::class,
            Basketball::class,
            Football::class,
        ];
    }
}
