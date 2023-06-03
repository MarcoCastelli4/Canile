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
        
        return view('user.adoption')->with("vaccination_list",$vaccinations)->with("dog_list",$dogs)
        ->with('user_id', $_SESSION["user_id"])->with('isAdmin', $_SESSION["isAdmin"])->with('logged',true);
        
    }

    public function store(Request $request)
    {
        $dl = new DataLayer();
        $request->validate([
            'malattia' => 'required',
            'validità' => 'required|integer|min:1',   
        ]);

        $dl->addVaccination($request->input('malattia'), $request->input('validità'));
        return Redirect::to(route('dog.index'));
    }
}
