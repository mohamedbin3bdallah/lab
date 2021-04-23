<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maincms extends Model
{
	protected $table = 'main_cms';
	
	protected $fillable = [
        'name', 'value_ar', 'value_en', 'status',
    ];

	public  $timestamps= true;
}
