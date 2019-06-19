<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Phone extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'code','en','th',
    ];
    public $timestamps = false;

    public function book()
    {
        return $this->hasMany('App\Book');
    }
}
