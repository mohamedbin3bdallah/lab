<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
	protected $table = 'patients';

	protected $fillable = [
        'name', 'email', 'code', 'phone', 'mobile', 'user_name', 'age', 'age_type', 'note', 'total_invoice', 'discount', 'accept', 'visit_date', 'branch_id', 'lab_id', 'status',
    ];
	
	protected $hidden = [
        'password',
    ];

	public  $timestamps= true;

	public function branch()
	{
		return $this->belongsTo('App\Branch', 'branch_id');
	}
	
	public function lab()
	{
		return $this->belongsTo('App\Lab', 'lab_id');
	}
	
	public function patient_test()
	{
		return $this->hasMany('App\Patienttest', 'patient_id', 'id');
	}
}
