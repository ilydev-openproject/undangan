<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rekening extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

}
