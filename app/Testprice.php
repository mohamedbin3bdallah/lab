<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testprice extends Model
{
	protected $table = 'price_list_tests';

	protected $fillable = [
        'list_id', 'test_id', 'price', 'status',
    ];

	public  $timestamps= true;

	public function price_list()
	{
		return $this->belongsTo('App\Pricelist', 'list_id');
	}
	
	public function test()
	{
		return $this->belongsTo('App\Test', 'test_id');
	}
}
