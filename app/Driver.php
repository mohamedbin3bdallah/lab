<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable
{
	use Notifiable;
	protected $table = 'drivers';

	protected $fillable = [
        'name', 'phone', 'mobile', 'latitude', 'longitude', 'status',
    ];
	
	/*protected $hidden = [
        'password',
    ];*/

	public  $timestamps= true;

	/*public function user()
	{
		return $this->hasOne('App\User', 'id' ,'user_id');
	}*/
}
