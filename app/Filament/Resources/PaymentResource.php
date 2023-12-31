<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Shop';
    protected static ?int $navigationSort = 4;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->label('Payment Time')->sortable(),
                Tables\Columns\TextColumn::make('product.name')->label('Product Name')
                    ->url(fn(Payment $record) => ProductResource::getUrl('edit', ['record' => $record->product])),
                Tables\Columns\TextColumn::make('user.name')->label('User Name')
                    ->url(fn(Payment $record) => UserResource::getUrl('edit', ['record' => $record->user])),
                Tables\Columns\TextColumn::make('user.email')->label('User Email'),
                Tables\Columns\TextColumn::make('voucher.code')->label('Voucher Code'),
                Tables\Columns\TextColumn::make('subtotal')->money('usd'),
                Tables\Columns\TextColumn::make('taxes')->money('usd'),
                Tables\Columns\TextColumn::make('total')->money('usd'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'],
                                fn($query) => $query->whereDate('created_at', '>=', $data['created_from']))
                            ->when($data['created_until'],
                                fn($query) => $query->whereDate('created_at', '<=', $data['created_until']));
                    })
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
        ];
    }

    public static function canCreate() : bool
    {
        return false;
    }

    public static function canDeleteAny() : bool
    {
        return false;
    }
}
