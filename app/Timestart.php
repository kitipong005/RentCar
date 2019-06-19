<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Timestart extends Authenticatable
{
    //
    use Notifiable;

    protected $fillable = [
        'detail',
    ];
    public $timestamps = false;
    protected $table = 'timestarts';

    public function book()
    {
        return $this->hasMany('App\Book');
    }
}
