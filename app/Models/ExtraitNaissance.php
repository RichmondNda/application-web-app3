<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraitNaissance extends Model
{
    use HasFactory;
    protected $connection = "mysql" ;
    protected $guarded = [];
}
