<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Gestionnaire extends Model
{
    use HasFactory;
    use HasApiTokens;
    use Notifiable ;

    public $connection = "mysql" ;
    



    
}
