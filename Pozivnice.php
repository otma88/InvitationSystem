<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;



class Pozivnice extends Model
{
    protected $table = 'pozivnice';

    protected $dates = [
      'poslano',
      'potvrdeno',
      'odbijeno'
    ];

    protected $fillable = ['email', 'poslano', 'potvrdeno', 'odbijeno', 'name', 'dodatni_gosti', 'poruka'];

    public function vjencanje() {
      return $this->belongsTo('App\Vjencanje');
    }


}
