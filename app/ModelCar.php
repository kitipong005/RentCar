<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ModelCar extends Authenticatable
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','brand_id',
    ];
    public $timestamps = false;
    protected $table = 'models';
    
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
    public function car()
    {
        return $this->hasMany('App\Car');
    }
}
