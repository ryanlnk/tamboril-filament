<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\OrderItemsRelationManager;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Leandrocfe\FilamentPtbrFormFields\Money;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema(static::getFormSchema())
                            ->columns(2),

                        Section::make('Order Items')
                            ->schema(static::getFormSchema('items')),
                    ])
                    ->columnSpan(3)
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order'),
                TextColumn::make('customer.name')->searchable(),
                TextColumn::make('total')->currency('BRL'),
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

    public static function getFormSchema(string $section = null): array
    {
        if ($section === 'items') {
            return [
                Repeater::make('orderItems')
                    ->relationship()
                    ->schema([
                        Select::make('product_id')
                            ->relationship('product', 'description')
                            ->required()
                            ->live()
                            ->columnSpan([
                                'md' => 5,
                            ])
                            ->afterStateUpdated(fn ($state, Set $set) => $set('sale_price', Product::find($state)?->sale_price ?? 0))
                            ->preload()
                            ->searchable(),

                        TextInput::make('quantity')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->columnSpan([
                                'md' => 2,
                            ]),

                        Money::make('sale_price')
                            ->required()
                            ->default(0)
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan([
                                'md' => 3,
                            ]),
                    ])
                    ->disableLabel()
                    ->columns([
                        'md' => 10,
                    ])
            ];
        }

        return [
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
                ->relationship('bankAccount', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Money::make('total')
                ->required()
                ->default(0)
                ->disabled()
                ->dehydrated(),
        ];
    }
}
