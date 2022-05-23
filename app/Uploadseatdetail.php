<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploadseatdetail extends Model
{
      protected $table = 'uploadseatdetails';
       protected $fillable = [
        'seatname', 'seatdeatails',
    ];
}
