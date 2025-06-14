<?php

namespace App\Filament\Resources;

use App\Models\Family;
use Filament\Forms;
use Filament\Tables;
use App\Models\Guest;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Resources\Components\Tab;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\GuestResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GuestResource\RelationManagers;

class GuestResource extends Resource
{
    protected static ?string $model = Guest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Tamu Undangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('invitation_id')
                    ->default(Auth::user()?->invitation?->id),
                TextInput::make('guests_name')
                    ->label('Nama Tamu')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->label('Slug')
                    ->readOnly()
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Tamu ini sudah ada',
                    ]),
                TextInput::make('wa')
                    ->label('Nomor Whatsapp')
                    ->placeholder('+628xxxxxxxxxx')
                    // This makes the field update visually when the user types or blurs
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (?string $state, Set $set) {
                        // Remove spaces and hyphens from the state for visual update
                        $cleanedState = str_replace([' ', '-'], '', $state);
                        $set('wa', $cleanedState);
                    })
                    // This ensures the value saved to the database is always clean
                    ->dehydrateStateUsing(fn(?string $state): ?string => str_replace([' ', '-'], '', $state))
                    ->required(),
                Select::make('role')
                    ->label('Role Tamu')
                    ->options([
                        'bride_guest' => 'Tamu Mempelai Wanita',
                        'groom_guest' => 'Tamu Mempelai Pria',
                        'bride_family_guest' => 'Tamu Keluarga Wanita',
                        'groom_family_guest' => 'Tamu Keluarga Pria',
                    ])
                    ->native(false)
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('guests_name')
                    ->label('Nama Tamu')
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),
                TextColumn::make('wa')
                    ->label('No. Whatsapp')
                    ->searchable(),
                TextColumn::make('role')
                    ->label('Role Tamu')
                    ->formatStateUsing(function (string $state) {
                        return match ($state) {
                            'bride_guest' => 'Tamu Mempelai Wanita',
                            'groom_guest' => 'Tamu Mempelai Pria',
                            'bride_family_guest' => 'Tamu Keluarga Wanita',
                            'groom_family_guest' => 'Tamu Keluarga Pria',
                            default => 'Tidak Diketahui',
                        };
                    })
                    ->badge(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('kirimWa')
                    ->label('Kirim WA')
                    ->color('success')
                    ->icon('heroicon-o-paper-airplane')
                    ->url(function ($record) {
                        $inv = $record->invitation;
                        $role = $record->role;
                        $tamu = $record->guests_name;
                        $slug = $record->slug;
                        $linkUndangan = "https://sesarengan.my.id/rika-ilyas/kepada/{$slug}";

                        $bride = $inv->bride_name ?? 'Mempelai Wanita';
                        $groom = $inv->groom_name ?? 'Mempelai Pria';

                        $families = $inv->family; // Eager-loaded relationship
            
                        $penutup = "{$groom} & {$bride}";

                        if ($role === 'groom_family_guest') {
                            $names = $families
                                ->whereIn('role', ['groom_father', 'groom_mother'])
                                ->where('is_deceased', false)
                                ->pluck('name')
                                ->toArray();

                            if (count($names) === 2) {
                                $penutup = implode(' & ', $names);
                            } elseif (!empty($names)) {
                                $penutup = implode(' & ', $names) . ' dan keluarga';
                            }

                        }

                        if ($role === 'bride_family_guest') {
                            $names = $families
                                ->whereIn('role', ['bride_father', 'bride_mother'])
                                ->where('is_deceased', false)
                                ->pluck('name')
                                ->toArray();

                            if (count($names) === 2) {
                                $penutup = implode(' & ', $names);
                            } elseif (!empty($names)) {
                                $penutup = implode(' & ', $names) . ' dan keluarga';
                            }

                        }

                        $pesan = <<<EOT
💐 UNDANGAN 💐

Kepada Yth.
Bapak/Ibu/Saudara/i
{$tamu}

Assalamualaikum Warahmatullahi Wabarakatuh

Dengan memohon rahmat dan ridho Allah SWT, perkenankan kami mengundang Bapak/Ibu/Saudara/i untuk menghadiri acara pernikahan kami.

Untuk informasi detail mengenai acara, silahkan kunjungi link :
{$linkUndangan}

Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan untuk hadir dan memberikan doa restu.

Atas kehadiran dan doa restunya kami ucapkan banyak terima kasih.

Wassalamualaikum Warahmatullahi Wabarakatuh

💌
Wedding e-Invitation ini merupakan undangan resmi dari kami, karena jarak & waktu kami mohon maaf apabila mengirim undangan melalui media online. Semoga tidak mengurangi rasa hormat, makna, serta isinya 🙏🏻

Hormat kami,
{$penutup}
EOT;

                        $pesanEncoded = urlencode($pesan);
                        $nomor = ltrim($record->wa, '+');

                        return "https://wa.me/{$nomor}?text={$pesanEncoded}";
                    })
                    ->openUrlInNewTab()
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    protected function getTableQuery(): Builder
    {
        return Family::query()->with(['invitation.families']);
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
            'index' => Pages\ListGuests::route('/'),
            // 'create' => Pages\CreateGuest::route('/create'),
            // 'edit' => Pages\EditGuest::route('/{record}/edit'),
        ];
    }
}
