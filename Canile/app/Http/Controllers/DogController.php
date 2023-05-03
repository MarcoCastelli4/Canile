<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Http\Request;

class DogController extends Controller
{
    public function index()
    {
        $dl=new DataLayer();
        // ottengo la lista
        $dogs=$dl->listDogs();
        return view('dog.index')->with("dog_list",$dogs);
        
    }
}
