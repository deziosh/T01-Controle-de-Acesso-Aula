<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use app\models\Noticia;
use app\models\User;

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

        Gate::before(function($user){
            if($user->admin === '1'){
                return true;
            }
        });
        //define um gate para cada coisa
        Gate::define('excluir-noticia', function(User $user, Noticia $noticia){
            //verifica se o usuário que solicita a exclusão é o mesmo que criou a noticia 
            return $user->id === $noticia->user_id;
        });
        
        Gate::define('visualizar-noticia', function(User $user, Noticia $noticia){
            //verifica se o usuário que solicita a exclusão é o mesmo que criou a noticia 
            return $user->id === $noticia->user_id;
        });

        Gate::define('editar-noticia', function(User $user, Noticia $noticia){
            //verifica se o usuário que solicita a exclusão é o mesmo que criou a noticia 
            return $user->id === $noticia->user_id;
        });
        //
    }
}
