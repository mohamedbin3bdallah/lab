<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qs extends Model
{
	protected $table = 'qs';

	protected $fillable = [
        'title'
    ];

	public  $timestamps= true;
}
