<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $fillable = ['nama', 'tahun', 'keterangan'];
}
