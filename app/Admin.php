<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table='admin';
    protected $orimaryKey='admin_id';
    public $timestamps='';
    protected $guarded=[];
}
