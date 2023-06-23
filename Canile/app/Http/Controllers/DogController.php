<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

class DogController extends Controller
{
    public function index()
    {
        session_start();
        $dl=new DataLayer();
        // ottengo la lista
        $dogs=$dl->getDogAvailable();
        $lista_razze=$dl->getAllRazzaValues();

        if(isset($_SESSION["loggedName"])){
            return view('dog.dogs')->with('lista_razze',$lista_razze)->with('user_id',$_SESSION["user_id"])->with('isAdmin',$_SESSION['isAdmin'])->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with("dog_list",$dogs);
        }
        else 
        return view('dog.dogs')->with('lista_razze',$lista_razze)->with('isAdmin', false)->with('logged', false)->with('loggedName', "")->with("dog_list",$dogs);
    }

    public function create()
    {
        $dl = new DataLayer();
        $dogs_list = $dl->listDogs();
        $vaccinations = $dl->getAllVaccinations();

        return view('dog.editDog')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with('dogList', $dogs_list)->with('vaccinations',$vaccinations)->with('isAdmin', $_SESSION["isAdmin"])->with('user_id', $_SESSION["user_id"]);
    }

    public function destroy($id)
    {
        $dl = new DataLayer();
        $book = $dl->findDogById($id);
        if ($book !== null) {
            if($dl->deleteDog($id)==false){
                Session::flash('dog_not_deleted');
            }
            
            return Redirect::to(route('dog.index'));
        } else {
            return view('dog.deleteErrorPage');
        }
        
    }

    public function confirmDestroy($id)
    {
        $dl = new DataLayer();
        $dog = $dl->findDogById($id);
        if ($dog !== null) {
            return view('dog.deleteDog')->with('dog', $dog)->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with('isAdmin', $_SESSION["isAdmin"])->with('user_id', $_SESSION["user_id"]);
        } else {
            return view('dog.deleteErrorPage')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with('isAdmin', $_SESSION["isAdmin"])->with('user_id', $_SESSION["user_id"]);
        }
    }

    // ipotizzo che posso inserire dei cani con info uguali, quindi non ho controlli nel database
    public function store(Request $request)
    {
        $dl = new DataLayer();
        $request->validate([
            'nome' => 'required',
            'razza' => 'required',
            'colore' => 'required',
            'lunghezzapelo' => 'required',
            'taglia' => 'required',
            'sesso' => 'required',
            'datanascita' => 'required',    
        ]);

        $dl->addDog($request->input('nome'), $request->input('razza'), $request->input('colore'),
        $request->input('lunghezzapelo'), $request->input('taglia'), $request->input('sesso'),
        $request->input('datanascita'),$request->file('documents'),$request->file('images'));

        // cane inserito correttamente
        Session::flash('dogstore');

        return Redirect::to(route('dog.index'));
    }


    public function edit($id)
    {
        $dl = new DataLayer();
        
        $dogs_list = $dl->listDogs();
        $dog = $dl->findDogById($id);
        
        return view('dog.editDog')->with('dogList', $dogs_list)->with('dog', $dog)->with('logged', true)->with('loggedName', $_SESSION["loggedName"])
        ->with('isAdmin', $_SESSION["isAdmin"])->with('user_id', $_SESSION["user_id"]);;//->with('vaccinations',$vaccinations);
    }

    public function update(Request $request, $id)
    {
        $dl = new DataLayer();
        $request->validate([
            'nome' => 'required',
            'razza' => 'required',
            'colore' => 'required',
            'lunghezzapelo' => 'required',
            'taglia' => 'required',
            'sesso' => 'required',
            'datanascita' => 'required',    
        ]);
        
        $dl->editDog($id,  $request->input('nome'), $request->input('razza'), $request->input('colore'),
        $request->input('lunghezzapelo'), $request->input('taglia'), $request->input('sesso'),
        $request->input('datanascita'),$request->file('documents'),$request->file('images'));

          // cane inserito correttamente
          Session::flash('dogedit');

        return Redirect::to(route('dog.index'));

    }

    public function info($id)
    {
        session_start();
        $dl=new DataLayer();
        
        $vaccinations=$dl->getAllVaccinations();
        $dog=$dl->findDogById($id);
        $images=$dl->getDogImages($id);
        $documents=$dl->getDogDocuments($id);
        
        if(isset($_SESSION["loggedName"])){
            
           return view('dog.infoDog')->with("documents",$documents)->with("images",$images)
           ->with("vaccination_list",$vaccinations)->with("dog",$dog)->with('logged', true)
           ->with('isAdmin', $_SESSION["isAdmin"])->with('loggedName', $_SESSION["loggedName"])
           ->with('user_id', $_SESSION["user_id"]);
        }
        else
        return view('dog.infoDog')->with("documents",$documents)->with("images",$images)->with("vaccination_list",$vaccinations)->with("dog",$dog)->with('logged', false)->with('loggedName', "");
        

       
    
    }

    /**Per la view che mi permette di inserire una vaccinazione per il cane in data */
    public function vaccination($id)
    {
        $dl=new DataLayer();
        $vaccinations=$dl->getAllVaccinations();
        $dog=$dl->findDogById($id);
        
        return view('dog.vaccination')->with("vaccination_list",$vaccinations)->with("dog",$dog)->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with('isAdmin',$_SESSION['isAdmin']);
    }

    public function addVaccination(Request $request, $dog_id)
    {
       
        $dl = new DataLayer();
        $request->validate([
            'dataVaccinazione' => 'required',    
        ]);

        $dl->addDogVaccination($dog_id, $request->input('vaccination_id'), $request->input('dataVaccinazione'));

        $vaccinations=$dl->getAllVaccinations();
        $dog=$dl->findDogById($dog_id);

          // vaccinazione inserita correttamente
          Session::flash('dogvaccination');
       
          return Redirect::to(route('dog.index'));
    }

   
    public function dogFilter(Request $request){
        // Update the dog_list variable with the filteredDogList
        // $dog_list=$request->input('dogList');

        session_start();
       
        $dl=new DataLayer();
        

        // ottengo le info da ajax
        $razza=$request->input('filterRazza');
        $taglia=$request->input('filterTaglia');
        $pelo=$request->input('filterPelo');
        $sesso=$request->input('filterSesso');

        $lista_razze=$dl->getAllRazzaValues();

        // richiamo metodo per filtrare i dati
        $dog_list_filtered=$dl->filterDog($razza,$taglia,$pelo,$sesso);

        if(isset($_SESSION["loggedName"])){
            return view('dog.dogs')->with('lista_razze',$lista_razze)->with("dog_list",$dog_list_filtered)->with('user_id',$_SESSION["user_id"])->with('isAdmin',$_SESSION['isAdmin'])->with('logged', true)->with('loggedName', $_SESSION["loggedName"]);
        }
        else 
        return view('dog.dogs')->with('lista_razze',$lista_razze)->with("dog_list",$dog_list_filtered)->with('isAdmin', false)->with('logged', false)->with('loggedName', "");
   
    }
}
