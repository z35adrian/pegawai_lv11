<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'nama',
        'alamat',
        'kelamin',
        'tgl_lahir',
        'tempat_lahir',
        'jobdesc',
        'jabatan',
        'tgl_masuk'
    ];
}
