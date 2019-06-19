<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Car extends Authenticatable
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'license', 'brand_id','model_id', 'type_id','seat','gear','door','air','price','count','pic',
    ];
    public $timestamps = false;

    public function model()
    {
        return $this->belongsTo('App\ModelCar');
    }
    public function type()
    {
        return $this->belongsTo('App\Type');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
    public function book()
    {
        return $this->hasMany('App\Book');
    }

}
