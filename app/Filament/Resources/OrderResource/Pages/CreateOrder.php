<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\Concerns\HasWizard;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    use HasWizard;

    protected static string $resource = OrderResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('Detalhes da venda')
                ->schema([
                    Section::make()->schema(OrderResource::getFormSchema())
                    ->columns(),
                ]),

            Step::make('Order Items')
                ->schema([
                    Section::make()->schema(OrderResource::getFormSchema('items')),
                ]),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
