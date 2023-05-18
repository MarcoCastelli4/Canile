<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table='image';
    protected $fillable=['path','dog_id'];

    public $timestamps=false;


    #un documento ha un solo cane
    public function dog(){
        return $this->hasOne(Dog::class,'document_id','id');
    }
}
