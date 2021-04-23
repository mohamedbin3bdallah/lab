<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
	protected $table = 'labs';

	protected $fillable = [
        'name', 'email', 'phone', 'mobile', 'latitude', 'longitude', 'notes', 'branch_id', 'price_list_id', 'status',
    ];
	
	protected $hidden = [
        'password',
    ];

	public  $timestamps= true;

	public function price_list()
	{
		return $this->hasOne('App\Pricelist', 'id', 'price_list_id');
	}
	
	public function branch()
	{
		return $this->belongsTo('App\Branch', 'branch_id');
	}
}
