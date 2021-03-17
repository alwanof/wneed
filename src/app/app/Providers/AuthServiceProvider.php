<?php

namespace App\Providers;

use App\Policies\UserPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        collect([
            'viewSetting',
            'manageSetting',
            'viewUser',
            'manageUser',
            'viewDriver',
            'manageDriver',
            'viewCategory',
            'manageCategory',
            'viewItem',
            'manageItem',
            'viewOrder',
            'manageOrder',
            'viewPref',
            'managePref',
            'viewQR',
            'manageQR',
        ])->each(function ($permission) {
            Gate::define($permission, function ($user) use ($permission) {
                return $user->hasRoleWithPermission($permission);
            });
        });
        $this->registerPolicies();

        //
    }
}
