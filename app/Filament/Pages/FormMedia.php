<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\Invitation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class FormMedia extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.form-media';


    public ?array $data = [];
    public function mount(): void
    {
        if (!auth()->check()) {
            abort(403, 'Anda harus login terlebih dahulu.');
        }

        $user = Auth::user();
        $invitation = $user->invitation;

        if (!$invitation) {
            Log::warning('No invitation found for user', ['user_id' => $user->id]);
            $this->form->fill();
            return;
        }

        $media = $invitation->getMedia('hero');
        $mediaUuids = $media->pluck('uuid')->toArray();

        Log::info('Mounting FormBasic', [
            'user_id' => $user->id,
            'invitation_id' => $invitation->id,
            'media_count' => count($media),
            'media_uuids' => $mediaUuids,
        ]);

        $this->form->fill([
            'foto' => $mediaUuids,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Undangan')
                    ->description('Masukkan informasi dasar untuk undangan Anda.')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('foto_bride')
                            ->label('Foto Wanita')
                            ->collection('bride_image')
                            ->disk('foto')
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('100')
                            ->downloadable()
                            ->lazy()
                            ->afterStateUpdated(function ($state) {
                                Log::info('Foto field state updated', ['state' => $state]);
                            }),
                        SpatieMediaLibraryFileUpload::make('foto_groom')
                            ->label('Foto Pria')
                            ->collection('groom_image')
                            ->disk('foto')
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('100')
                            ->downloadable()
                            ->lazy()
                            ->afterStateUpdated(function ($state) {
                                Log::info('Foto field state updated', ['state' => $state]);
                            }),
                        Group::make([
                            SpatieMediaLibraryFileUpload::make('foto')
                                ->label('Foto Hero')
                                ->collection('hero')
                                ->disk('foto')
                                ->multiple()
                                ->maxFiles(4)
                                ->image()
                                ->imageEditor()
                                ->imagePreviewHeight('100')
                                ->downloadable()
                                ->lazy()
                                ->reorderable()
                                ->afterStateUpdated(function ($state) {
                                    Log::info('Foto field state updated', ['state' => $state]);
                                }),

                            SpatieMediaLibraryFileUpload::make('foto_gallery')
                                ->label('Foto Galery')
                                ->collection('foto_gallery')
                                ->disk('foto')
                                ->multiple()
                                ->maxFiles(4)
                                ->image()
                                ->imageEditor()
                                ->imagePreviewHeight('100')
                                ->downloadable()
                                ->lazy()
                                ->reorderable()
                                ->afterStateUpdated(function ($state) {
                                    Log::info('Foto field state updated', ['state' => $state]);
                                }),
                        ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ])
            ->statePath('data')
            ->model(auth()->user()->invitation ?? Invitation::class);
    }

    public function submit(): void
    {
        $user = Auth::user();
        $data = $this->form->getState();

        Log::info('Submitting FormBasic', [
            'user_id' => $user->id,
            'form_data' => $data,
        ]);

        // Simpan data invitation
        $invitation = $user->invitation()->updateOrCreate(
            ['user_id' => $user->id],
        );

        // Simpan media
        $this->form->model($invitation)->saveRelationships();

        // Verifikasi media setelah simpan
        $media = $invitation->getMedia('hero');
        Log::info('Media saved', [
            'invitation_id' => $invitation->id,
            'media_count' => count($media),
            'media_uuids' => $media->pluck('uuid')->toArray(),
        ]);

        Notification::make()
            ->title('Berhasil!')
            ->body('Data berhasil disimpan.')
            ->success()
            ->send();

        // Refresh form
        $this->form->fill([
            'slug' => $invitation->slug,
            'foto' => $media->pluck('uuid')->toArray(),
        ]);
    }
}
