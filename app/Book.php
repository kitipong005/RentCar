<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Book extends Authenticatable
{
    //
    use Notifiable;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_id','user_id','landmark_id','name','phone_id','phone','email','s_date','s_time','e_date','e_time','addr','district','amphoe','province','zipcode','code','days','times','price','status','exp',
    ];

    public function car()
    {
        return $this->belongsTo('App\Car');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function landmark()
    {
        return $this->belongsTo('App\Landmark','landmark_id');
    }
    public function phone()
    {
        return $this->belongsTo('App\Phone','phone_id');
    }
    public function timestart()
    {
        return $this->belongsTo('App\Timestart','s_time');
    }
    public function timeend()
    {
        return $this->belongsTo('App\Timeend','e_time');
    }
    public function payment()
    {
        return $this->hasMany('App\Payments');
    }
}
