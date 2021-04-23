<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patienttest extends Model
{
	protected $table = 'patient_tests';

	protected $fillable = [
        'patient_id', 'test_id', 'price', 'file_path', 'status',
    ];

	public  $timestamps= true;
	
	public function patient()
	{
		return $this->belongsTo('App\Patient', 'patient_id');
	}
	
	public function test()
	{
		return $this->belongsTo('App\Test', 'test_id');
	}
}
