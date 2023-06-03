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
        
        $req->validate([
            'l_email' =>'required|email',
            'l_password' => 'required',

        ],
        [

            'l_email.email' => 'The email must be a valid email address.',
            'l_email.required' => 'The email field is required.',
            'l_password.required' => 'The password field is required.'

        ]);

        //metodo per verificare che l'utente sia valido
        if($dl->validUser($req->input('l_email'),$req->input('l_password'))){
            //salvo le info dell'utente
            $_SESSION['logged']=true;
            $_SESSION['loggedName']=$dl->getUserName($req->input('l_email'));
            $_SESSION['user_id']=$dl->getUserId($req->input('l_email'));
            $_SESSION['email']=$req->input('l_name');
            
            // salvo la variabile globale di admin
            $_SESSION['isAdmin']=$dl->isAdmin($req->input('l_email'));

           
           return Redirect::to(route('dog.index'));
        }
        return view('auth.authErrorPage');
    }

    public function logout() {
        session_start();
        session_destroy();
        return Redirect::to(route('home'));
    }

    public function registration(Request $req) {
        $dl = new DataLayer();
        
        $req->validate([
            'name' => 'required',
            'password' => 'required',
            'email' =>'required|unique:users,email',
            'password' => 'required|min:6|same:confirm-password',
            'confirm-password' => 'required|min:6',
        ]);


        $dl->addUser($req->input('name'), $req->input('password'), $req->input('email'));

        return Redirect::to(route('user.login'));
    }
}
