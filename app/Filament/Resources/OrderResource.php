<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Venda')
                    ->description('Detalhes da venda')
                    ->icon('heroicon-m-shopping-bag')
                    ->schema([
                        TextInput::make('order')
                            ->default('OR-' . random_int(5000, 999999))
                            ->disabled()
                            ->dehydrated()
                            ->required(),

                        DatePicker::make('date')
                            ->default(today()),

                        Select::make('payment_id')
                            ->relationship('payment', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('seller_id')
                            ->relationship('seller', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('customer_id')
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('bank_account_id')
                            ->relationship('bank_account', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('total')
                            ->prefix('R$')
                            ->default(0)
                            ->disabled()
                            ->dehydrated()
                    ])->columns(2)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order'),
                TextColumn::make('customer.name')->searchable(),
                TextColumn::make('total'),
                TextColumn::make('date')->sortable()->date()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
