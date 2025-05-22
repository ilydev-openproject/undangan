<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Invitation extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif'])
            ->maxNumberOfFiles(4);

        $this->addMediaCollection('bride_image')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif'])
            ->singleFile();

        $this->addMediaCollection('groom_image')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif'])
            ->singleFile();

        $this->addMediaCollection('foto_gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif'])
            ->maxNumberOfFiles(4);
    }

}
