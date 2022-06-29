<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Users', User::query()->count()),
            Card::make('Organizations', Organization::query()->count()),
            Card::make('Contacts', Contact::query()->count())
                ->description('32k increase')
                ->descriptionIcon('heroicon-s-trending-up'),
        ];
    }
}
