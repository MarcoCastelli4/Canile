<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    /**Rimando alla vista */
    public function authentication(){
        return view('auth.auth');
    }

    /**Per passare i dati dalla form uso http requestm, quando faccio req->input() mi riferisco ai dati che provengono  da form*/
    public function login(Request $req){
        session_start();    //funzione php che mi inizializza la sessione
        $dl=new DataLayer();
        
        //metodo per verificare che l'utente sia valido
        if($dl->validUser($req->input('email'),$req->input('password'))){
            //salvo le info dell'utente
            $_SESSION['logged']=true;
            $_SESSION['loggedName']=$dl->getUserName($req->input('email'));
            $_SESSION['email']=$req->input('name');
            
           return Redirect::to(route('dog.index'));
        }
        return view('auth.authErrorPage');
    }

    public function logout() {
        session_start();
        session_destroy();
        return Redirect::to(route('home'));
    }
}
