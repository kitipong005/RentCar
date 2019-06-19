<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Brand extends Authenticatable
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;
    protected $table = 'brands';
    public function model()
    {
        return $this->hasMany('App\ModelCar');
    }
    public function car()
    {
        return $this->hasMany('App\Car');
    }
    
}
