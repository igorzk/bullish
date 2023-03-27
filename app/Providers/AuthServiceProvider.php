<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('view-files', function (User $user) {
            return $user->canViewFiles();
        });

        Gate::define('view-investors', function (User $user) {
            return $user->canViewInvestors();
        });

        Gate::define('create-entity', function (User $user) {
            return $user->canCreateEntity();
        });

        Gate::define('create-account', function (User $user) {
            return $user->canCreateAccount();
        });

        Gate::define('create-event', function (User $user) {
            return $user->canCreateEvent();
        });

        Gate::define('update-portfolios', function (User $user) {
            return $user->canUpdatePortfolios();
        });

        Gate::define('see-portfolio-performance', function (User $user) {
            return $user->canSeePortfolioPerformance();
        });


    }
}
