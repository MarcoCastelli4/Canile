<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VaccinationController extends Controller
{
    public function index()
    {
        $dl=new DataLayer();
        // ottengo la lista delle vaccinazioni
        $vaccinations=$dl->getAllVaccinations();
        $dogs=$dl->listDogs();
        
        return view('vaccination.index')->with("vaccination_list",$vaccinations)->with("dog_list",$dogs);
        
    }
}
