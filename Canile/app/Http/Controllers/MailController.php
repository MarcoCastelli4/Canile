<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Mail\ConfirmAdoption;
use Session;

class MailController extends Controller
{
    public function sendMail($dog_id,$user_id){

        if($user_id!=$_SESSION["user_id"]){
            Session::flash('id_user_fail'); 
            return Redirect::to(route('dog.index'));
        }

        $dl=new DataLayer(); 

        $emailto=$dl->getUserMail($user_id);
        $name=$dl->getUserName($emailto);
        $dog=$dl->findDogById($dog_id);
       
        if(is_null($dog)){
            Session::flash('id_dog_fail'); 
            return Redirect::to(route('dog.index'));
        }
        
        Mail::to($emailto)->send(new ConfirmAdoption($name,$dog));

        
        return Redirect::to(route('dog.index',));

    }
}
