<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Mail\ConfirmAdoption;

class MailController extends Controller
{
    public function sendMail($dog_id,$user_id){
        $dl=new DataLayer(); 
        $dogs=$dl->getDogAvailable();

        $emailto=$dl->getUserMail($user_id);
        $name=$dl->getUserName($emailto);
        $dog=$dl->getDog($dog_id);
        
        Mail::to($emailto)->send(new ConfirmAdoption($name,$dog));

        
        return Redirect::to(route('dog.index',));

    }
}
