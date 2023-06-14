<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Szerelo extends Model
{
    protected $table = 'szerelo';
    protected $primaryKey = 'SzereloID';
    use HasFactory;
}
