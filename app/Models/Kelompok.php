<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function training() {
        return $this->belongsTo(Training::class);
    }

    public function materi() {
        return $this->hasOne(Materi::class);
    }

    public function kuis() {
        return $this->hasMany(Kuis::class);
    }
}
