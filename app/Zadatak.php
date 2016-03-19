<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zadatak extends Model
{
    //
    protected $table = "zadaci";
    protected $fillable = [
    	'status', 'opis_zadatka', 'status', 'datum_zavrsetka', 'vrijeme_otvaranja'
    ];

}
