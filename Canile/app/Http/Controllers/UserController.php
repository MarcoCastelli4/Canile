<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function adoption($id)
    {
        $dl=new DataLayer();
        
        $dog=$dl->findDogById($id);
        $userID = $dl->getUserID($_SESSION["loggedName"]);
        return view('user.adoption')->with("dog",$dog)->with('logged', true)->with('loggedName', $_SESSION["loggedName"]);
        
    }

    public function addAdoption($id)
    {

        $dl=new DataLayer(); 
        $dogs=$dl->listDogs();

         // inserimento nel db ...
        return view('dog.index')->with("dog_list",$dogs); 
    }
}
