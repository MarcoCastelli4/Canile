<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    protected $table='adoption';
    protected $fillable=['dog_id','user_id','data'];

    public $timestamps=false;

    #un adozione ha un solo utente
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    # un cane può essere associato ad una sola adozione
    public function dog(){
        return $this-> belongsTo(Dog::class,'dog_id','id');
    }

}
