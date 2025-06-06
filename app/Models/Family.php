<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class, 'invitation_id');
    }
}
