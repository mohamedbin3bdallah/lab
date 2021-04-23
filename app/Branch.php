<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
	protected $table = 'branches';

	protected $fillable = [
        'name_ar', 'name_en', 'email', 'phone', 'mobile', 'user_name', 'address_ar', 'address_en', 'latitude', 'longitude', 'status',
    ];
	
	protected $hidden = [
        'password',
    ];

	public  $timestamps= true;

	public function user()
	{
		return $this->hasOne('App\User', 'id' ,'user_id');
	}
	
	public function lab()
	{
		return $this->hasMany('App\Lab', 'branch_id', 'id');
	}
}
