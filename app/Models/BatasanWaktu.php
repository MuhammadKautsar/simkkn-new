<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatasanWaktu extends Model
{
    use HasFactory;

    protected $table = 'batasan_waktu';

    protected $guarded = [];

    public $timestamps = false;
}
