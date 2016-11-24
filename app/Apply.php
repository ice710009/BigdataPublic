<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    //
	protected $fillable = [
        'type', 'department', 'apply_date', 'name', 'phone', 'email', 'purpose', 'way', 'ip', 'account', 'password', 'location',
		'form1_need', 
		'form2_need', 'form2_need_other', 'form2_filter_enter', 'form2_filter_id', 'form2_filter_status',
		'form3_need', 'form3_need_other', 
		'form3_filter_no', 'form3_filter_department', 'form3_filter_title', 'form3_filter_start', 'form3_filter_end', 'form3_filter_program', 'form3_filter_financial',
    ];
}
