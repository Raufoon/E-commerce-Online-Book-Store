<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    //
    protected $table = 'user_type';

    public $timestamps = false;

    protected $fillable = array('id','type');
}
