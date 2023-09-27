<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Leandrocfe\FilamentPtbrFormFields\Money;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Produtos')
                    ->schema([
                        TextInput::make('name')
                            ->required(),

                        TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->default(1),

                        Money::make('buy_price')
                            ->required(),

                        // TextInput::make('buy_price')
                        //     ->numeric()
                        //     ->inputMode('decimal')
                        //     ->prefix('R$')
                        //     ->placeholder('1,99')
                        //     ->required(),

                        // TextInput::make('sale_price')
                        //     ->numeric()
                        //     ->inputMode('decimal')
                        //     ->prefix('R$')
                        //     ->placeholder('1,99')
                        //     ->required(),

                        Money::make('sale_price')
                            ->required(),

                        DatePicker::make('date')
                            ->default(today()),


                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->live(),

                        Fieldset::make('Blusas')
                            ->schema([
                                TextInput::make('color'),
                                // ->visible(fn (Get $get): Collection => Category::query()
                                //     ->where('id', $get(1))
                                //     ->get()),

                                TextInput::make('size'),

                                TextInput::make('genre'),
                            ])
                            // ->relationship('category', 'name')
                            ->visible(fn (Get $get) => $get('category_id') == 1)
                            ->columns(3),


                        Fieldset::make('Livros')
                            ->schema([
                                TextInput::make('ISBN'),

                                Toggle::make('box')
                                    ->inline(false)
                                    ->onColor('success'),
                            ])
                            ->visible(fn (Get $get) => $get('category_id') == 2)
                            ->columns(3),
                    ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('quantity'),
                TextColumn::make('sale_price')->currency('BRL'),
                TextColumn::make('date')->date(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
