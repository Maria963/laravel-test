<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'company_id',
        'phone'
    ];

    public function company() 
    {
        return $this->belongsTo('App\Models\Company', 'id', 'company_id'); 
    }
}
