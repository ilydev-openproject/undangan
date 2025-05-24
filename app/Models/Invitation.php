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
    public function invitation()
    {
        return $this->hasMany(Invitation::class, 'invitation_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);

        $this->addMediaCollection('bride_image')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif'])
            ->singleFile();

        $this->addMediaCollection('groom_image')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif'])
            ->singleFile();

        $this->addMediaCollection('foto_gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);
    }

    public function family()
    {
        return $this->hasMany(Family::class, 'invitation_id');
    }

    public function brideFather()
    {
        return $this->hasOne(Family::class, 'invitation_id')->where('role', 'bride_father');
    }

    public function brideMother()
    {
        return $this->hasOne(Family::class, 'invitation_id')->where('role', 'bride_mother');
    }

    public function groomFather()
    {
        return $this->hasOne(Family::class, 'invitation_id')->where('role', 'groom_father');
    }

    public function groomMother()
    {
        return $this->hasOne(Family::class, 'invitation_id')->where('role', 'groom_mother');
    }

    public function event()
    {
        return $this->hasMany(Event::class, 'invitation_id');
    }
    public function story()
    {
        return $this->hasMany(Story::class, 'invitation_id');
    }
    public function rekening()
    {
        return $this->hasMany(Rekening::class);
    }
    public function guest()
    {
        return $this->hasMany(Guest::class);
    }

}
