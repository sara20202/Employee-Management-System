<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function employees(){
        return $this->hasMany('App\User');
    }

    public $fillable = ['title','parent_id'];
    
    public function childs() {
        return $this->hasMany('App\Department','parent_id','id') ;
}
public function users()
    {
        return $this->hasMany('App\User');
    }
}

