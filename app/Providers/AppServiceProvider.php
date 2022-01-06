<?php

namespace App\Providers;

use App\Models\Cup;
use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('cup-change', function (User $user, Cup $cup){
            return ($cup->user_id == $user->id);
        });
        Gate::define('game-change', function (User $user, Game $game){
            return ($game->user_id == $user->id);
        });
    }
}
