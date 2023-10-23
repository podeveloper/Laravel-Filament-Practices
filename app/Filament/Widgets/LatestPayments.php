<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPayments extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Payment::with('product')->latest()->take(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->label('Time'),
                Tables\Columns\TextColumn::make('total')->money(),
                Tables\Columns\TextColumn::make('product.name'),
            ]);
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
