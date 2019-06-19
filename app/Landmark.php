<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Landmark extends Authenticatable
{
    
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameTH', 'nameEN','priceTranspot',
    ];

    public function book()
    {
        return $this->hasMany('App\Book');
    }
}
