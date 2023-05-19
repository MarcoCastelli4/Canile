<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $table='dog';
    protected $fillable=['nome','razza','colore','lunghezza pelo','taglia','sesso','data nascita','user_id'];

    public $timestamps=false;

    # un cane può avere  un solo utente è associato ha un solo autore
    /*
    public function food(){
        return $this->belongsToMany(Food::class,'dog_food','dog_id','food_id')
        ->withPivot(['data']);
    }*/

    # un cane ha tante vaccinaizoni
    public function vaccination(){
        return $this->belongsToMany(Vaccination::class,'dog_vaccination','dog_id','vaccination_id')
        ->withPivot(['data']);
    }

    # un cane ha tanti documenti
    public function document(){
        return $this-> hasMany(Document::class,'dog_id','id');
            
    }

     # un cane ha tanti documenti
     public function image(){
        return $this-> hasMany(Image::class,'dog_id','id');
            
    }
    #un cane ha un solo utente
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}

