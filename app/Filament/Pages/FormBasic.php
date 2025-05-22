<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\Invitation;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Spatie\MediaLibrary\InteractsWithMedia;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class FormBasic extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.form-basic';
    protected static ?string $title = 'Detail Invitation';

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
        $this->form->fill([
            'slug' => $invitation->slug,
            'groom_name' => $invitation->groom_name,
            'groom_title' => $invitation->groom_title,
            'bride_name' => $invitation->bride_name,
            'bride_title' => $invitation->bride_title,
            'event_date' => $invitation->event_date,
            'groom_nickname' => $invitation->groom_nickname,
            'bride_nickname' => $invitation->bride_nickname,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Undangan')
                    ->description('Masukkan informasi dasar untuk undangan Anda.')
                    ->schema([
                        TextInput::make('slug')
                            ->label('Slug Undangan')
                            ->prefix(config('app.url') . '/')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('contoh-undangan')
                            ->helperText('Slug akan digunakan sebagai bagian dari URL undangan, misalnya: ' . config('app.url') . '/nama-slug')
                            ->unique(
                                table: Invitation::class,
                                column: 'slug',
                                ignorable: fn() => auth()->user()->invitation
                            )
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state));
                            })
                            ->reactive(),

                        DatePicker::make('event_date')
                            ->label('Hari Pernikahan')
                            ->required()
                            ->native(false),
                        TextInput::make('groom_nickname')
                            ->label('Nama Panggilan Pria')
                            ->required()
                            ->placeholder('Masukkan nama panggilan mempelai pria')
                            ->maxLength(100),
                        TextInput::make('bride_nickname')
                            ->label('Nama Panggilan Wanita')
                            ->required()
                            ->placeholder('Masukkan nama panggilan mempelai wanita')
                            ->maxLength(100),
                        Group::make([
                            TextInput::make('groom_name')
                                ->label('Nama Lengkap Pria')
                                ->required()
                                ->placeholder('Masukkan nama lengkap mempelai pria')
                                ->maxLength(100)
                                ->columnSpan(2),
                            TextInput::make('groom_title')
                                ->label('Title')
                                ->placeholder('S.Kom./S.E.')
                                ->maxLength(100)
                                ->columnSpan(1),
                        ])
                            ->columns(3),
                        Group::make([
                            TextInput::make('bride_name')
                                ->label('Nama Lengkap Wanita')
                                ->required()
                                ->placeholder('Masukkan nama lengkap mempelai wanita')
                                ->maxLength(100)
                                ->columnSpan(2),
                            TextInput::make('bride_title')
                                ->label('Title')
                                ->placeholder('S.Kom./S.E.')
                                ->maxLength(100)
                                ->columnSpan(1),
                        ])
                            ->columns(3),

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

        // Simpan data invitation
        $invitation = $user->invitation()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'slug' => $data['slug'],
                'groom_nickname' => $data['groom_nickname'],
                'groom_title' => $data['groom_title'],
                'bride_nickname' => $data['bride_nickname'],
                'bride_title' => $data['bride_title'],
                'groom_name' => $data['groom_name'],
                'bride_name' => $data['bride_name'],
                'event_date' => $data['event_date'],
            ]
        );

        // Simpan media
        $this->form->model($invitation)->saveRelationships();
        Notification::make()
            ->title('Berhasil!')
            ->body('Data berhasil disimpan.')
            ->success()
            ->send();

        // Refresh form
        $this->form->fill([
            'slug' => $invitation->slug,
            'groom_nickname' => $invitation->groom_nickname,
            'groom_title' => $invitation->groom_title,
            'bride_nickname' => $invitation->bride_nickname,
            'bride_title' => $invitation->bride_title,
            'groom_name' => $invitation->groom_name,
            'bride_name' => $invitation->bride_name,
            'event_date' => $invitation->event_date,
        ]);
    }
}
