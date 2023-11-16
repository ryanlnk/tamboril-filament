<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Leandrocfe\FilamentPtbrFormFields\Money;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationGroup = 'Produtos';

    protected static ?string $navigationLabel = 'Produtos';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Produtos')
                    ->schema(static::getFormSchema())
                    ->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('quantity')->sortable(),
                TextColumn::make('sale_price')->currency('BRL'),
                TextColumn::make('date')->date()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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

    public static function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->autofocus()
                ->required(),

            TextInput::make('quantity')
                ->numeric()
                ->required()
                ->default(1),

            DatePicker::make('date')
                ->required()
                ->native(false)
                ->displayFormat('d/m/Y')
                ->default(today()),

            Money::make('buy_price')
                ->required(),

            Money::make('sale_price')
                ->required(),

            Select::make('category_id')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->live()
                ->afterStateUpdated(function (Set $set) {
                    $set('color', '');
                    $set('size', '');
                    $set('genre', '');
                    $set('ISBN', '');
                    $set('box', false);
                }),

            Fieldset::make('Camisetas')
                ->schema([
                    TextInput::make('color')
                        ->default(''),

                    TextInput::make('size')
                        ->default(''),

                    TextInput::make('genre')
                        ->default(''),
                ])
                ->visible(fn (Get $get) => $get('category_id') == 1)
                ->columns(3),

            Fieldset::make('Livros')
                ->schema([
                    TextInput::make('ISBN')
                        ->default(''),

                    Toggle::make('box')
                        ->inline(false)
                        ->onColor('success'),
                ])
                ->visible(fn (Get $get) => $get('category_id') == 2)
                ->columns(3),

            Textarea::make('description')
                ->required()
                ->columnSpanFull(),

            Actions::make([
                Action::make('Gerar Descrição')
                    ->action(
                        function (Set $set, Get $get) {
                            $set(
                                'description',

                                $get('name')
                                    . ' ' . $get('color')
                                    . ' ' . $get('size')
                                    . ' ' . $get('genre')
                                    . ' ' . $get('ISBN')
                            );
                        }
                    ),

                Action::make('Limpar')
                    ->color('danger')
                    ->action(
                        function (Set $set) {
                            $set('description', '');
                        }
                    )
            ])
        ];
    }
}
