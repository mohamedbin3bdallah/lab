<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	protected $table = 'tests';

	protected $fillable = [
        'name', 'sample', 'precaution', 'process_day', 'status',
    ];

	public  $timestamps= true;

	public function test_price()
	{
		return $this->hasMany('App\Testprice', 'test_id', 'id');
	}
}

