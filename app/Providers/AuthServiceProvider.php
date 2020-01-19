<?php

namespace App\Providers;

use App\Enums\UserRole;
use App\Hashing\Sha1Hasher;
use App\News;
use App\Policies\CommentPolicy;
use App\Policies\NewsPolicy;
use App\Policies\RealmlistPolicy;
use App\Realmlist;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use PhpParser\Comment;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        News::class => NewsPolicy::class,
        Comment::class => CommentPolicy::class,
        Realmlist::class => RealmlistPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Hash::extend('sha1', fn () => new Sha1Hasher());

        Gate::after(fn (User $user) => $user->role->is(UserRole::Admin));
    }
}
