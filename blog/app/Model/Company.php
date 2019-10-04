<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];

    public function employees() {
        return $this->hasMany('App\Model\Employee', 'company', 'id');
    }
}
