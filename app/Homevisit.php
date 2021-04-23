<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homevisit extends Model
{
	protected $table = 'home_visits';
	
	protected $fillable = [
        'patient_name', 'patient_phone', 'address', 'date', 'notes', 'file_upload', 'status',
    ];

	public  $timestamps= true;
}
