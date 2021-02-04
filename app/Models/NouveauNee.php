<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NouveauNee extends Model
{
    use HasFactory;

    protected $connection = 'mysql_hopitale' ;
    protected $guarded = [];
}
