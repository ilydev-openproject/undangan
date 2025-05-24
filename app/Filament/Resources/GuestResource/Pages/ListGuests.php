<?php

namespace App\Filament\Resources\GuestResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\GuestResource;
use Filament\Resources\Pages\ListRecords;

class ListGuests extends ListRecords
{
    protected static string $resource = GuestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('Semua'),
            'Mempelai Wanita' => Tab::make()->query(fn($query) => $query->where('role', 'bride_guest')),
            'Mempelai Pria' => Tab::make()->query(fn($query) => $query->where('role', 'groom_guest')),
            'Keluarga Wanita' => Tab::make()->query(fn($query) => $query->where('role', 'bride_family_guest')),
            'Keluarga Pria' => Tab::make()->query(fn($query) => $query->where('role', 'groom_family_guest')),
        ];
    }
}
