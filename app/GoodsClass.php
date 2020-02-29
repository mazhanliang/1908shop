<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsClass extends Model
{
    protected $table='goods_class';
    protected $orimaryKey='c_id';
    public $timestamps='';
    protected $guarded=[];
}
