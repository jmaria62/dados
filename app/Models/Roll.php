<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roll extends Model
{
    use HasFactory;

    //para poder hacer inserts masivos crear el array $guarded
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
