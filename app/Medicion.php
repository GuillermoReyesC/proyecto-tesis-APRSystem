<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Medicion extends Model
{
    use Notifiable;

    protected $table = 'medicion';
    public $timestamps = false;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
    'id','id_sensor','dato','create_at'
    ];
}
