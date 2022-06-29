<?php

namespace App\Providers;

use App\Filament\Resources\UserResource;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        Model::unguard();
        Filament::serving(function () {
            Filament::registerTheme(mix('css/app.css'));
            Filament::registerUserMenuItems([
                'account' => UserMenuItem::make()
                    ->label('Your Profile')
                    ->url(UserResource::getUrl(
                        'edit',
                        ['record' => auth()->user()]
                    )),
                UserMenuItem::make()
                    ->label('Manage Users')
                    ->url(UserResource::getUrl())
                    ->icon('heroicon-s-users'),
            ]);
        });
    }
}
