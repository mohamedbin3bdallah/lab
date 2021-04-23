<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $table = 'offers_services';

	protected $fillable = [
        'title_en','title_ar', 'description_en', 'description_ar', 'flag', 'image', 'status',
    ];

	public  $timestamps= true;
}
