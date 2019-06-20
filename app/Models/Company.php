<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'companies';

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [ 
        'name', 'email', 'logo', 'website', 
     ];

    protected $hidden = [ 
        'remember_token',
     ];

    public function employee()
    {
        return $this->hasMany('App\Models\Employee');
    }
}
