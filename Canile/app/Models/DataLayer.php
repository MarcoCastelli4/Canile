<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;

class DataLayer {
    public function listDogs(){
        //restituisco la lista di tutti i cani ordinati prima per cognome e poi per nome
       return Dog::orderBy('nome','asc')->orderBy('razza','asc')->get();

   }

    public function findDogById($id) {
        return Dog::find($id);
    }

    public function findVaccinationById($id) {
        return Vaccination::find($id);
    }

    // cancellare un cane
    public function deleteDog($id) {
        $dog = Dog::find($id);

         // Il cane è adottato quindi non cancellabile dal database
        $adoptions = Adoption::query();
        if($adoptions->where('dog_id', $id)->count() > 0){
                return false;
        }
        else{
        $vaccination = $dog->vaccination;
        
        // Delete the associated images from the storage
    foreach ($dog->image as $image) {
        Storage::delete('public'.$image->path);
        $image->delete();
    }

    foreach ($dog->document as $document) {
        Storage::delete('public'.$document->path);
        $document->delete();
    }
        foreach($vaccination as $v) {
            $dog->vaccination()->detach($v->id);
        }
        $dog->delete();
         return true;
     }
    }

    // salva  img nel database e dentro la cartella
    public function uploadImage($image,$dog):void{
        $v = Image::count()+1;
        $i=new Image();
        $i->path='/img/upload/'.$dog->id.'-'.$v.'.png';
        $i->dog_id=$dog->id;
        $i->save();

        $image->storeAs('public/img/upload',$dog->id.'-'.$v.'.png');
    }

    // salva  documenti nel database e dentro la cartella
    public function uploadDocument($document,$dog):void{
        $v = Document::count()+1;
        $i=new Document();
        $i->titolo=$document->getClientOriginalName();
        $i->path='/document/upload/'.$dog->id.'-'.$v.'.pdf';
        $i->dog_id=$dog->id;
        $i->save();

        $document->storeAs('public/document/upload',$dog->id.'-'.$v.'.pdf');
    }


   // aggiungere un cane senza nessuna vaccinazione
   public function addDog($nome,$razza,$colore,$lunghezzapelo,$taglia,$sesso,$datanascita,$documents,$images) {
    $dog = new Dog;
    $dog->nome = $nome;
    $dog->razza = $razza;
    $dog->colore = $colore;
    $dog['lunghezza pelo']=$lunghezzapelo;
    $dog->taglia = $taglia;
    $dog->sesso = $sesso;
    $dog['data nascita']=$datanascita;
    $dog->save();


    // aggiungo le immagini
    if (isset($images)){
    foreach($images as $i){
        $this->uploadImage($i,$dog);
       }
    }

    // aggiungo i documenti
    if (isset($documents)){
        foreach($documents as $d){
         $this->uploadDocument($d,$dog);
        }
       }
    }



    public function getAllVaccinations() {
       return Vaccination::orderBy('malattia','asc')->get();
    }   

    public function getDogImages($id)
    {
        $dog = Dog::find($id);
        return $dog->image;
    }

    public function getDogDocuments($id)
    {
        $dog = Dog::find($id);
        return $dog->document;
    }

    public function editDog($id, $nome,$razza,$colore,$lunghezzapelo,$taglia,$sesso,$datanascita,$documents,$images) {
        $dog = Dog::find($id);
        $dog->nome = $nome;
        $dog->razza = $razza;
        $dog->colore = $colore;
        $dog['lunghezza pelo']=$lunghezzapelo;
        $dog->taglia = $taglia;
        $dog->sesso = $sesso;
        $dog['data nascita']=$datanascita;

        if (isset($images)){
        foreach($images as $i){
         $this->uploadImage($i,$dog);
        }
       }

       if (isset($documents)){
        foreach($documents as $d){
         $this->uploadDocument($d,$dog);
        }
       }

       /*
        // Cancel the previous list of vaccinations
        $prevVaccination = $dog->vaccination;
        foreach($prevVaccination as $prev) {
            $dog->vaccination()->detach($prev->id);
        }*/

        $dog->save();

    }

    
    // Aggiunge vaccinazione per cane
    public function addDogVaccination($dog_id,$vaccination_id,$data) {
       
       $vaccination=Vaccination::find($vaccination_id);
       $dog = Dog::find($dog_id);
       $dog->vaccination()->attach($vaccination,['data'=>$data]);
        
    }

    //Aggiunge adozione cane - utente
    public function addDogAdoption($dog_id,$user_id) {

        $dog = Dog::find($dog_id);

        // controlla che è già adottato
        if ($dog->adoption()->exists()){
           return false;
        }
        else{
            $adoption = new Adoption;
            $adoption->dog_id=$dog_id;
            $adoption->user_id=$user_id;
            $adoption->data= now()->format('Y-m-d');
    
            $adoption->save();
            return true;
        }
       

         
     }

     public function validUser($email,$password){
         //prendo l'utente con la mail specificata
        $users = User::where('email',$email)->get(['password']);
        if(count($users) == 0)
        {
            return false;
        }
        //ha inserito psw corretta?
        return (md5($password) == ($users[0]->password));
     }

     // verifico se è l'admin
     public function isAdmin($email){
       $user=User::where('isAdmin',1)->get(['email']);
       if(count($user) == 0)
        {
            return false;
        }
        return $email==($user[0]->email);
    }
 
     public function getUserName($email){
         $users=User::where('email',$email)->get();
         return $users[0]->name;
     }

     public function getUserId($email){
        $users=User::where('email',$email)->get();
        return $users[0]->id;
    }

    public function getUserMail($id){
        $users=User::where('id',$id)->get();
        return $users[0]->email;
    }

     // restituisco i cani disponibili per l'adozione
     public function getDogAvailable(){
        return Dog::doesntHave('adoption')->get();
 
     }

    
     // abbiamo già il controllo nel validator se email già presente nel database
     public function addUser($name, $password, $email) {
        $user = new User();
        $user->name = $name;
        $user->password = md5($password);
        $user->email = $email;
        $user->save();
        
    }
    
    public function addVaccination($malattia,$validità){
        $vaccination = new Vaccination();
        $vaccination->malattia=$malattia;
        $vaccination->validità=$validità;

        $vaccination->save();
    }

    public function getMyDogs($user_id){
        $user = User::find($user_id);
        $dogs = $user->adoption->map(function ($adoption) {
            return $adoption->dog;
        });
        return $dogs;

    }

    public function getAllReviews(){
        return Review::orderByDesc('data')->get();

    }

    public function addReview($titolo,$contenuto,$valutazione,$user_id){
        $review = new Review;
        $review->titolo=$titolo;
        $review->contenuto=$contenuto;
        $review->valutazione=$valutazione;
        $review->data= now()->format('Y-m-d');
        $review->user_id=$user_id;
        $review->save();
    }

    public function getAllRazzaValues()
    {
    $razzaValues = Dog::query()
        ->pluck('razza')
        ->all();

    return $razzaValues;
    }
    // per il filtraggio
    public function filterDog($razza,$taglia,$pelo,$sesso){
        $dogs = Dog::query();
        if(!is_null($razza)){
            $dogs->where('razza', $razza);
        }
        if(!is_null($taglia)){
            $dogs->where('taglia', $taglia);
        }
        if(!is_null($sesso)){
            $dogs->where('sesso', $sesso);
        }
        if(!is_null($pelo)){
            $dogs->where('lunghezza pelo', $pelo);
        }

    return $dogs->get();
    }

    // per ordinare
    public function orderDog($value){
        $dogs = Dog::all();

        if ($value === 'Anziani') {
            $dogs = $dogs->sortBy('data nascita');
        } elseif ($value === 'Cuccioli') {
            $dogs = $dogs->sortByDesc('data nascita');
        }

    return $dogs;
    }
}
