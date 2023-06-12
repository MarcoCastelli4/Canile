<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

class UserController extends Controller
{

    public function index($id)
    {
        $dl=new DataLayer();
        // ottengo la lista
        $dogs=$dl->getMyDogs($id);
        if(isset($_SESSION["loggedName"])){
           return view('user.dogs')->with('user_id',$_SESSION["user_id"])->with('isAdmin',$_SESSION['isAdmin'])->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with("dog_list",$dogs);
        }
         
    }


    public function adoption($id)
    {
        $dl=new DataLayer();
        
        $dog=$dl->findDogById($id);
        
        return view('user.adoption')->with("dog",$dog)->with('logged', true)->with('loggedName', $_SESSION["loggedName"])
        ->with('user_id', $_SESSION["user_id"])->with('isAdmin', $_SESSION["isAdmin"]);
        
    }

    public function addAdoption(Request $request,$id)
    {

        $dl=new DataLayer(); 
        $dog_id=$id;

        $request->validate([
            'accept_terms' => 'required',    
        ]);
        if($dl->addDogAdoption($dog_id,$_SESSION["user_id"])==false){
            Session::flash('dog_adoption_error');
        }
        else{
            Session::flash('dog_adopted');
        }

        //$dogs=$dl->getDogAvailable();
      //  return Redirect::to(route('dog.index'));
      return Redirect::to(route('mail.confirm',[$dog_id,$_SESSION["user_id"]]));
        
    }
}
