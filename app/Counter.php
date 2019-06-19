<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Counter extends Model
{
    //
    use Notifiable;

    public $table = "counters";
    protected $fillable = [
        'DATE','IP',
    ];
    public $timestamps = false;
}
