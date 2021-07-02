<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport; // add this 
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes(); // Add this
	//Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(24));
	Passport::personalAccessTokensExpireIn(Carbon::now()->addDays(24));
	//Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
