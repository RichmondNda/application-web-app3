<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnregistrementDemande extends Model
{
    use HasFactory;

    public $connection = "mysql";

    public $guarded = [];
}
