<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table='user';
    protected $orimaryKey='u_id';
    public $timestamps='';
    protected $guarded=[];
}
