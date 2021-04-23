<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
	protected $table = 'cms';

	protected $fillable = [
        'page_flag', 'section','title_ar','title_en','content_ar','content_en','image','link', 'status',
    ];

	public  $timestamps= true;
}
