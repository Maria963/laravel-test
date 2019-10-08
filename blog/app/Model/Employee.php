<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'company',
        'phone'
    ];

    public function company() 
    {

        return $this->belongsTo('App\Model\Company', 'id', 'company');
        
    }
}
