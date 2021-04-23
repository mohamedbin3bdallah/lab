<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
	protected $table = 'feedback';

	protected $fillable = [
        'title', 'description', 'lab_id', 'status',
    ];

	public  $timestamps= true;

	public function lab()
	{
		return $this->belongsTo('App\Lab', 'lab_id');
	}
}
