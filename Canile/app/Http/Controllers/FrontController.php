<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getHome()
    {
        
        session_start();
        if (isset($_SESSION['logged'])) {
            return view('homepage')->with('user_id',$_SESSION["user_id"])->with('isAdmin',$_SESSION['isAdmin'])->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
        } else {
            return view('homepage')->with('logged', false);
        }
        
    }

    public function getAboutUs()
    {
        session_start();
        if (isset($_SESSION['logged'])) {
            return view('aboutUs')->with('user_id',$_SESSION["user_id"])->with('isAdmin',$_SESSION['isAdmin'])->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
        } else {
            return view('aboutUs')->with('logged', false);
        }
    }


    public function getContactUs()
    {
        session_start();
        if (isset($_SESSION['logged'])) {
            return view('contactUs')->with('user_id',$_SESSION["user_id"])->with('isAdmin',$_SESSION['isAdmin'])->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
        } else {
            return view('contactUs')->with('logged', false);
        }
    }
}
