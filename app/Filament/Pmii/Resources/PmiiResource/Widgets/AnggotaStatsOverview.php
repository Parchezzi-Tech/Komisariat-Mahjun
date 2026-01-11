<?php

namespace App\Filament\Pmii\Resources\PmiiResource\Widgets;

use Filament\Widgets\ChartWidget;

class AnggotaStatsOverview extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
