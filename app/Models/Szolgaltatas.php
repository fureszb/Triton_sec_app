<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Szolgaltatas extends Model
{
    protected $table = 'szolgaltatas';
    protected $primaryKey = 'SzolgID';
    use HasFactory;
}
