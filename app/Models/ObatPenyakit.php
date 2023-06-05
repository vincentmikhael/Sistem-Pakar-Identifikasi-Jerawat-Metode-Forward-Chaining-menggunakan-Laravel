<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObatPenyakit extends Model
{
    use HasFactory;
    protected $table = 'obat_penyakit';

    public $timestamps = false;
}
