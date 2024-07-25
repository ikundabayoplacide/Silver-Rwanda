<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Sanctum\PersonalAccessToken;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        // Passport::loadKeysFrom(__DIR__ . '/../secrets/oauth');
        // Passport::hashClientSecrets();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        // $this->registerPolicies();
        // Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        // Passport::routes();

        Passport::enablePasswordGrant();
    }
}