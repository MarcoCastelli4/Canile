<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $table='vaccination';
    protected $fillable=['malattia','validità'];

    public $timestamps=false;


    # una vaccinazione ha più cani
    public function dog()
    {
        return $this->belongsToMany(Dog::class,'dog_vaccination','vaccination_id','dog_id')
        ->withPivot(['data']);
    }
}
