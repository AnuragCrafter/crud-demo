<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    public $timestamps = false;
    use HasFactory;
    public $fillable =  [
        'id',
        'name',
    ];
}
