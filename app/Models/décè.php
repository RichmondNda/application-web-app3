<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class décè extends Model
{
    use HasFactory;
    protected $connection = 'mysql_hopitale';
    protected $guarded = [];
}
