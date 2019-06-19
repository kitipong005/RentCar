<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Daily extends Model
{
    //
    use Notifiable;

    public $table = "dailys";

    protected $fillable = [
        'DATE','NUM',
    ];
    public $timestamps = false;
}
