<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $table='dog';
    protected $fillable=['nome','razza','colore','lunghezza pelo','taglia','sesso','data nascita'];

    public $timestamps=false;

    # un cane ha tante vaccinaizoni
    public function vaccination(){
        return $this->belongsToMany(Vaccination::class,'dog_vaccination','dog_id','vaccination_id')
        ->withPivot(['data']);
    }

    # un cane ha tanti documenti
    public function document(){
        return $this-> hasMany(Document::class,'dog_id','id');
            
    }

     # un cane ha tante immagini
     public function image(){
        return $this-> hasMany(Image::class,'dog_id','id');
            
    }

    #un cane è rifetito ad una sola adozione
    public function adoption(){
        return $this->hasOne(Adoption::class,'dog_id','id');
    }
    

}

