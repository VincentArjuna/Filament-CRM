<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;

class ContactsChart extends LineChartWidget
{
    protected static ?string $heading = 'Chart';

    //protected static ?string $pollingInterval = '400ms';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 2;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Contacts created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                    'backgroundColor' => 'red'
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
