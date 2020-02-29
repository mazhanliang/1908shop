<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table='goods';
    protected $orimaryKey='goods_id';
    public $timestamps='';
    protected $guarded=[];
}
