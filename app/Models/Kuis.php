<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public function kelompok() {
    //     return $this->belongsTo(Kelompok::class);
    // }
}
