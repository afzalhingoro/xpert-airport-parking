<?php

namespace App\Providers;

use App\Models\users_menus;
use App\Models\users_roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define("user_auth",function ($user,$permission=null){

            $user_id = Auth::id();
            return users_roles::check_is_exist_role($user_id,$permission);
        });
        
        Gate::define("menu_auth",function ($user,$menu_name){

            $user_id = Auth::id();
            return users_roles::check_is_exist_menu($user_id,$menu_name);

        });
    }
}
