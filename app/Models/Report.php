<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'report';

    public $timestamps = false;

    protected $fillable = ['penyakit_id','user_id','tanggal'];
}
