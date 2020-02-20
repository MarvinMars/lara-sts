<?php

namespace App\Providers;

use App\Models\Player;
use App\Models\Season;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('stats_player', function ($id) {
            return Player::find($id) ?? abort(404, 'Player does not exist.');
        });

        Route::bind('stats_season', function ($id) {
            return Season::find($id) ?? abort(404, 'Season does not exist.');
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapFrontendRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapFrontendRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace . '\Frontend')
            ->as('frontend.')
            ->group(base_path('routes/frontend.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api/v1')
            ->as('api.')
            ->middleware(['api'])
            ->namespace($this->namespace . '\Api\v1')
            ->group(base_path('routes/api/v1.php'));
    }
}
