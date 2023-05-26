<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    public function index($id)
    {
        $dl=new DataLayer();
        // ottengo la lista
        $dogs=$dl->getMyDogs($id);
        if(isset($_SESSION["loggedName"])){
           return view('dog.dogs')->with('user_id',$_SESSION["user_id"])->with('isAdmin',$_SESSION['isAdmin'])->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with("dog_list",$dogs);
        }
         
    }


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
        $dog_id=$id;
        $user_id = $dl->getUserID($_SESSION["loggedName"]);
        $dl->addDogAdoption($dog_id,$user_id);
        $dogs=$dl->getDogAvailable();
        
        return view('dog.dogs')->with('isAdmin',$_SESSION['isAdmin'])->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with("dog_list",$dogs);
    }
}
