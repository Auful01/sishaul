<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blanko extends Model
{
    use HasFactory;

    protected $table = 'blanko';

    protected $fillable =[
        'nama',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'desa',
        'detail',
        'tipe',
        'status',
        'maps',
        'foto'
    ];


}
