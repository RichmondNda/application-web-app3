<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistreNaissance extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql_mairie' ;
    protected $guarded = [];
}
