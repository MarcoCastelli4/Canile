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
        return view('user.adoption')->with("dog",$dog);
        
    }

    public function addAdoption($id)
    {

        $dl=new DataLayer();
        
        $dog=$dl->findDogById($id);
        print "Cane adottato";


        // inserimento nel db ...
        return  view('user.adoption')->with("dog",$dog);
        
    }
}
