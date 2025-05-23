<?php

namespace App\Filament\Pages;

use Filament\Forms;
use App\Models\Family;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\Invitation;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
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
            'groom_child_order' => $invitation->groom_child_order,
            'groom_ig_username' => $invitation->groom_ig_username,
            'groom_link' => $invitation->groom_link,
            'bride_nickname' => $invitation->bride_nickname,
            'bride_child_order' => $invitation->bride_child_order,
            'bride_ig_username' => $invitation->bride_ig_username,
            'bride_link' => $invitation->bride_link,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar')
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
                                ->label('Titel')
                                ->placeholder('S.Kom./S.E.')
                                ->maxLength(100)
                                ->columnSpan(1),
                            TextInput::make('groom_ig_username')
                                ->label('Username Ig')
                                ->prefixIcon('heroicon-o-at-symbol')
                                ->columnSpan(4),
                            TextInput::make('groom_link')
                                ->label('Link Profile Ig')
                                ->prefix('https://')
                                ->columnSpan(4),
                            TextInput::make('groom_child_order')
                                ->label('Putra ke?')
                                ->placeholder('Pertama, Kedua, Ketiga')
                                ->maxLength(100)
                                ->columnSpan(4),
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
                                ->label('Titel')
                                ->placeholder('S.Kom./S.E.')
                                ->maxLength(100)
                                ->columnSpan(1),
                            TextInput::make('bride_ig_username')
                                ->label('Username Ig')
                                ->prefixIcon('heroicon-o-at-symbol')
                                ->columnSpan(4),
                            TextInput::make('bride_link')
                                ->label('Link Profile Ig')
                                ->prefix('https://')
                                ->columnSpan(4),
                            TextInput::make('bride_child_order')
                                ->label('Putri ke?')
                                ->placeholder('Pertama, Kedua, Ketiga')
                                ->maxLength(100)
                                ->columnSpan(4),
                        ])
                            ->columns(3),
                    ])
                    ->columns(2)
                    ->collapsible(),
                Section::make('Keluarga')
                    ->description('Masukkan semua data keluarga anda.')
                    ->schema([
                        Repeater::make('family')
                            ->label('Masukkan Keluarga')
                            ->relationship('family')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama')
                                    ->columnSpan(3),
                                TextInput::make('title')
                                    ->label('Titel')
                                    ->columnSpan(2),
                                Select::make('role')
                                    ->label('Keluarga')
                                    ->options([
                                        'bride_mother' => 'Ibu Mempelai Wanita',
                                        'groom_mother' => 'Ibu Mempelai Pria',
                                        'bride_father' => 'Ayah Mempelai Wanita',
                                        'groom_father' => 'Ayah Mempelai Pria',
                                    ])
                                    ->native(false)
                                    ->required()
                                    ->columnSpan(3),
                                Toggle::make('is_deceased')
                                    ->label('sudah menginggal?')
                                    ->columnSpanFull()
                            ])
                            ->defaultItems(3)
                            ->deletable()
                            ->reorderable()
                            ->maxItems(4)
                            ->reorderableWithButtons()
                            ->columns(8)
                            ->columnSpanFull()
                    ])
                    ->collapsed(),
                Section::make('Acara')
                    ->description('Masukkan semua data acara anda.')
                    ->schema([
                        Repeater::make('acara')
                            ->label('Masukkan Acara')
                            ->relationship('event')
                            ->schema([
                                TextInput::make('name')
                                    ->placeholder('Akad Nikah/Resepsi/Ngunduh Mantu')
                                    ->label('Nama')
                                    ->columnSpan(3),
                                DatePicker::make('event_date')
                                    ->label('Tanggal Acara')
                                    ->native(false)
                                    ->columnSpan(3),
                                TimePicker::make('waktu')
                                    ->label('Waktu')
                                    ->native(false)
                                    ->columnSpan(2),
                                TextInput::make('location')
                                    ->label('Lokasi')
                                    ->placeholder('Jl. ninuninu, kp. durian runtuh')
                                    ->columnSpan(4),
                                TextInput::make('gmap_link')
                                    ->label('Link Google Maps')
                                    ->prefix('https://')
                                    ->columnSpan(4)
                            ])
                            ->defaultItems(1)
                            ->deletable()
                            ->reorderable()
                            ->maxItems(4)
                            ->reorderableWithButtons()
                            ->columns(8)
                            ->columnSpanFull()
                    ])
                    ->collapsed(),
                Section::make('Story')
                    ->description('Ceritakan kisah asmara anda dengan pasangan.')
                    ->schema([
                        Repeater::make('cerita')
                            ->label('Tulis Cerita')
                            ->relationship('story')
                            ->schema([
                                TextInput::make('title')
                                    ->placeholder('Pertemuan/main kerumah/dijodohkan')
                                    ->label('Judul')
                                    ->columnSpan(4),
                                Select::make('urutan')
                                    ->placeholder('Pengurutan')
                                    ->label('Urutan')
                                    ->options([
                                        '1' => 'Pertama',
                                        '2' => 'Kedua',
                                        '3' => 'Ketiga',
                                        '4' => 'Keempat',
                                        '5' => 'Kelima',
                                        '6' => 'Keenam',
                                        '7' => 'Ketujuh',
                                        '8' => 'Kedelapan',
                                        '9' => 'Kesembilan',
                                        '10' => 'Kesepuluh',
                                    ])
                                    ->native(false)
                                    ->columnSpan(4),
                                Textarea::make('cerita')
                                    ->placeholder('Ceritakan disini')
                                    ->label('Cerita')
                                    ->columnSpanFull(),
                            ])
                            ->defaultItems(1)
                            ->deletable()
                            ->reorderable()
                            ->maxItems(4)
                            ->reorderableWithButtons()
                            ->columns(8)
                            ->columnSpanFull()
                    ])
                    ->collapsed(),
                Section::make('Rekening')
                    ->description('Masukkan informasi rekening untuk hadiah digital.')
                    ->schema([
                        Repeater::make('rekenings')
                            ->label('Daftar Rekening')
                            ->relationship('rekening')
                            ->schema([
                                Select::make('role')
                                    ->label('Untuk Siapa?')
                                    ->options([
                                        'bride' => 'Mempelai Wanita',
                                        'groom' => 'Mempelai Pria',
                                    ])
                                    ->required()
                                    ->native(false)
                                    ->columnSpan(4),
                                Select::make('bank_id')
                                    ->label('Nama Bank')
                                    ->relationship('bank', 'name')
                                    ->preload()
                                    ->native(false)
                                    ->searchable()
                                    ->columnSpan(4),
                                TextInput::make('nama')
                                    ->label('Nama Pemilik')
                                    ->placeholder('Nama di rekening')
                                    ->required()
                                    ->maxLength(100)
                                    ->columnSpan(4),
                                TextInput::make('nomor_rekening')
                                    ->label('Nomor Rekening')
                                    ->placeholder('1234567890')
                                    ->required()
                                    ->maxLength(100)
                                    ->columnSpan(4),
                            ])
                            ->defaultItems(2)
                            ->deletable()
                            ->reorderable()
                            ->maxItems(6)
                            ->reorderableWithButtons()
                            ->columns(8)
                            ->columnSpanFull()
                    ])
                    ->collapsed(),
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
                'groom_child_order' => $data['groom_child_order'],
                'groom_ig_username' => $data['groom_ig_username'],
                'groom_link' => $data['groom_link'],
                'bride_name' => $data['bride_name'],
                'bride_child_order' => $data['bride_child_order'],
                'bride_ig_username' => $data['bride_ig_username'],
                'bride_link' => $data['bride_link'],
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
            'groom_child_order' => $invitation->groom_child_order,
            'groom_ig_username' => $invitation->groom_ig_username,
            'groom_link' => $invitation->groom_link,
            'bride_name' => $invitation->bride_name,
            'bride_child_order' => $invitation->bride_child_order,
            'bride_ig_username' => $invitation->bride_ig_username,
            'bride_link' => $invitation->bride_link,
            'event_date' => $invitation->event_date,
        ]);
    }
}
