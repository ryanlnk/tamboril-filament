<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\OrderItemsRelationManager;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    /**
     * Formatações do menu lateral
     */
    protected static ?string $navigationGroup = 'VENDAS';

    protected static ?string $navigationLabel = 'Vendas';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 1;

    /**
     * Formatações do título e botões
     */
    protected static ?string $modelLabel = 'venda';

    protected static ?string $pluralModelLabel = 'vendas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema(static::getFormSchema())
                            ->columns(2),

                        Section::make()
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
                TextColumn::make('order')
                    ->label('Número de venda'),

                TextColumn::make('customer.name')
                    ->searchable()
                    ->label('Cliente'),

                TextColumn::make('total')
                    ->currency('BRL')
                    ->label('Total'),

                TextColumn::make('date')
                    ->sortable()
                    ->date()
                    ->label('Data'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make()
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
                Grid::make(3)
                    ->schema([
                        TextInput::make('sum')
                            ->disabled()
                            ->prefix('R$')
                            ->placeholder(function (Get $get, Set $set) {
                                $items = array_column($get('orderItems'), ('subtotal'));
                                $sum = array_sum($items);
                                $set('sum', number_format($sum, 2));
                            })
                            ->label('Subtotal'),

                        TextInput::make('discount')
                            ->dehydrated(false)
                            ->prefix('R$')
                            ->live(onBlur: true)
                            ->default(number_format(0, 2))
                            ->placeholder(function ($state, Set $set) {
                                if ($state == '' || $state < 0)
                                    $set('discount', number_format(0, 2));
                            })
                            ->label('Desconto'),

                        TextInput::make('total')
                            ->required()
                            ->live()
                            ->disabled()
                            ->dehydrated()
                            ->prefix('R$')
                            // ->default(number_format(0,2))
                            ->placeholder(function ($state, Get $get, Set $set) {
                                //ISTO DAQUI NÃO ESTÁ RESOLVIDO
                                // if ($get('discount') > $state)
                                //     $set('total', number_format(0, 2));

                                // if ()
                                //     $set('total', Order::find($state)->total ?? (number_format(0, 2)));

                                $set('total', number_format($get('sum') - $get('discount'), 2));
                            })
                            ->label('Total'),
                    ]),

                Repeater::make('orderItems')
                    ->relationship()
                    ->schema([
                        Select::make('product_id')
                            ->relationship('product', 'description')
                            ->required()
                            ->live(onBlur: true)
                            ->preload()
                            ->searchable()
                            ->afterStateUpdated(function ($state, Set $set) {
                                $set('sale_price', Product::find($state)->sale_price ?? (number_format(0, 2)));
                            })
                            ->columnSpan([
                                'md' => 4,
                            ])
                            ->label('Produto'),

                        TextInput::make('quantity')
                            ->required()
                            ->numeric()
                            ->live()
                            ->default(1)
                            ->disabled(fn (Get $get) => $get('product_id') == null)
                            ->columnSpan([
                                'md' => 2,
                            ])
                            ->placeholder(function ($state, Set $set) {
                                if ($state == '' || $state < 0)
                                    $set('quantity', 0);
                            })
                            ->label('Quantidade'),

                        TextInput::make('sale_price')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->prefix('R$')
                            ->default(number_format(0, 2))
                            ->columnSpan([
                                'md' => 2,
                            ])
                            ->label('Preço'),

                        TextInput::make('subtotal')
                            ->disabled()
                            ->prefix('R$')
                            ->placeholder(function (Get $get, Set $set) {
                                $set('subtotal', number_format($get('quantity') * $get('sale_price'), 2, '.', ','));
                            })
                            ->columnSpan([
                                'md' => 2,
                            ])
                            ->label('Subtotal'),
                    ])
                    ->live()
                    ->disableLabel()
                    ->columns([
                        'md' => 10,
                    ])
                    ->label('itens da venda')
            ];
        }

        return [
            TextInput::make('order')
                ->default('OR-' . random_int(5000, 999999))
                ->disabled()
                ->dehydrated()
                ->required()
                ->label('Número da venda'),

            DatePicker::make('date')
                ->native(false)
                ->displayFormat('d/m/Y')
                ->default(today())
                ->label('Data'),

            Select::make('customer_id')
                ->relationship('customer', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->label('Cliente'),

            Select::make('seller_id')
                ->relationship('seller', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->label('Vendedor'),

            Select::make('payment_id')
                ->relationship('payment', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->label('Forma de pagamento'),

            Select::make('bank_account_id')
                ->relationship('bankAccount', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->label('Conta bancária'),
        ];
    }
}
