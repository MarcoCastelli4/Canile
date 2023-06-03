<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    public function index()
    {
        session_start();
        $dl=new DataLayer();
        $reviews=$dl->getAllReviews();
        
        if(isset($_SESSION["loggedName"])){
            return view('review.index')->with('review_list',$reviews)->with('user_id',$_SESSION["user_id"])->with('isAdmin',$_SESSION['isAdmin'])->with('logged', true)->with('loggedName', $_SESSION["loggedName"]);
         }
         else{
            return view('review.index')->with('review_list',$reviews)->with('isAdmin',false)->with('logged', false);
         }
    }


    public function store(Request $request)
    {
        session_start();
        $dl = new DataLayer();
        $request->validate([
            'titolo' => 'required',
            'contenuto' => 'required', 
        ]);

        $dl->addReview($request->input('titolo'), $request->input('contenuto'), $request->input('valutazione'),$_SESSION["user_id"]);
        return Redirect::to(route('review.index'));
    }
}
