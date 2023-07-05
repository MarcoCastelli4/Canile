<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;


class VaccinationController extends Controller
{
    
    public function index($id)
    {
        $dl=new DataLayer();
        $dog_list=$dl->getMyDogs($id);
        
        return view('user.adoption')->with("vaccination_list",$vaccinations)->with("dog_list",$dogs)
        ->with('user_id', $_SESSION["user_id"])->with('isAdmin', $_SESSION["isAdmin"])->with('logged',true);
        
    }

    public function edit()
    {
        $dl = new DataLayer();
        
        return view('vaccination.edit')->with('user_id', $_SESSION["user_id"])
        ->with('isAdmin', $_SESSION["isAdmin"])->with('logged',true)->with('loggedName', $_SESSION["loggedName"]);
    }

    public function store(Request $request)
    {
        $dl = new DataLayer();

        $validatedData = $request->validate([
            'malattia' => 'required|unique:vaccination',
            'validita' => 'required|integer|min:1',
        ],
    ['malattia.required' => 'Il campo malattia è richiesto.',
    'validita.required' => 'Il campo validità è richiesto.',
    'malattia.unique' => 'Malattia già presente nel database',
    'validita.integer' => 'Il campo validità deve essere un numero intero.',
    'validita.min' => 'Il campo validità deve essere almeno :1.',

]);
        
        $dl->addVaccination($request->input('malattia'), $request->input('validita'));
        
        Session::flash('vaccinationstore');
    
        return Redirect::to(route('dog.index'));        
    }
}
