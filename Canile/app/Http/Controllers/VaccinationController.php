<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VaccinationController extends Controller
{
    
    public function index($id)
    {
        $dl=new DataLayer();
        $dog_list=$dl->getMyDogs($id);
        
        return view('user.adoption')->with("vaccination_list",$vaccinations)->with("dog_list",$dogs);
        
    }

    public function store(Request $request)
    {
        $dl = new DataLayer();
        $dl->addVaccination($request->input('malattia'), $request->input('validità'));
        return Redirect::to(route('dog.index'));
    }
}
