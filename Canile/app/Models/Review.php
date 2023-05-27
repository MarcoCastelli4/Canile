<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    
    protected $table='review';
    protected $fillable=['titolo','contenuto','data','valutazione','user_id'];

    public $timestamps=false;

    #un recensione ha un solo utente
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
