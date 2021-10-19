<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facturacion extends Model
{
  protected $table = 'facturacion';

  public $timestamps = false;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
    'id','user','date','monto'
    ];
}
