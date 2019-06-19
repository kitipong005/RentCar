<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Timeend extends Authenticatable
{
    //
    use Notifiable;

    protected $fillable = [
        'detail',
    ];
    public $timestamps = false;
    
    public function book()
    {
        return $this->hasMany('App\Book');
    }
}
