<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricelist extends Model
{
	protected $table = 'price_lists';

	protected $fillable = [
        'name', 'status',
    ];

	public  $timestamps= true;

	public function test_price()
	{
		return $this->hasMany('App\Testprice', 'list_id', 'id');
	}
	
	public function lab()
	{
		return $this->belongsToMany('App\Lab', 'price_list_id');
	}
}
