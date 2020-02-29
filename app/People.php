<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table='people';
    protected $orimaryKey='id';
    public $timestamps='';
    protected $guarded=[];
}
