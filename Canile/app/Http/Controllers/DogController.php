<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DogController extends Controller
{
    public function index()
    {
        $dl=new DataLayer();
        // ottengo la lista
        $dogs=$dl->listDogs();
        return view('dog.dogs')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with("dog_list",$dogs);
        
    }

    public function create()
    {
        $dl = new DataLayer();
        $dogs_list = $dl->listDogs();
        $vaccinations = $dl->getAllVaccinations();

        return view('dog.editDog')->with('dogList', $dogs_list)->with('vaccinations',$vaccinations);
    }

    public function destroy($id)
    {
        $dl = new DataLayer();
        $book = $dl->findDogById($id);
        if ($book !== null) {
            $dl->deleteDog($id);
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
            return view('dog.deleteDog')->with('dog', $dog);
        } else {
            return view('dog.deleteErrorPage');
        }
    }

    public function store(Request $request)
    {
        $dl = new DataLayer();
        $dl->addDog($request->input('nome'), $request->input('razza'), $request->input('colore'),
        $request->input('lunghezzapelo'), $request->input('taglia'), $request->input('sesso'),
        $request->input('datanascita'));


        return Redirect::to(route('dog.index'));
    }


    public function edit($id)
    {
        $dl = new DataLayer();
        $dogs_list = $dl->listDogs();
        $dog = $dl->findDogById($id);
       // $vaccinations = $dl->getAllVaccinatios();

        return view('dog.editDog')->with('dogList', $dogs_list)->with('dog', $dog);//->with('vaccinations',$vaccinations);
    }

    public function update(Request $request, $id)
    {
        $dl = new DataLayer();
        $dl->editDog($id,  $request->input('nome'), $request->input('razza'), $request->input('colore'),
        $request->input('lunghezzapelo'), $request->input('taglia'), $request->input('sesso'),
        $request->input('datanascita'));
        return Redirect::to(route('dog.index'));

    }

    public function info($id)
    {
        $dl=new DataLayer();
        
        $vaccinations=$dl->getAllVaccinations();
        $dog=$dl->findDogById($id);

        return view('dog.infoDog')->with("vaccination_list",$vaccinations)->with("dog",$dog);
    
    }

    /**Per la view che mi permette di inserire una vaccinazione per il cane in data */
    public function vaccination($id)
    {
        $dl=new DataLayer();
        $vaccinations=$dl->getAllVaccinations();
        $dog=$dl->findDogById($id);
        return view('dog.vaccination')->with("vaccination_list",$vaccinations)->with("dog",$dog);
    }

    public function addVaccination(Request $request, $dog_id)
    {
        $dl = new DataLayer();
        $dl->addDogVaccination($dog_id, $request->input('vaccination_id'), $request->input('dataVaccinazione'));

        $vaccinations=$dl->getAllVaccinations();
        $dog=$dl->findDogById($dog_id);
       
        // sarebbe bello mettere popup hai inserito vaccinazione
        return view('dog.vaccination')->with("vaccination_list",$vaccinations)->with("dog",$dog);
    }

   
}
