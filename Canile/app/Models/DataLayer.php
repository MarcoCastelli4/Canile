<?php

namespace App\Models;


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
        $vaccination = $dog->vaccination;

        // disassocio immagini e documenti associati
        $dog->image()->delete();

        $dog->document()->delete();
       
        foreach($vaccination as $v) {
            $dog->vaccination()->detach($v->id);
        }

       
        $dog->delete();
    }

    // salva  img nel database e dentro la cartella
    public function uploadImage($image,$dog):void{
        $v = Image::count()+1;
        $i=new Image();
        $i->path='/img/upload/'.$dog->id.$v.'.png';
        $i->dog_id=$dog->id;
        $i->save();

        $image->storeAs('public/img/upload',$dog->id.$v.'.png');
    }

    // salva  documenti nel database e dentro la cartella
    public function uploadDocument($document,$dog):void{
        $v = Document::count()+1;
        $i=new Document();
        $i->titolo=$document->getClientOriginalName();
        $i->path='/document/upload/'.$dog->id.$v.'.pdf';
        $i->dog_id=$dog->id;
        $i->save();

        $document->storeAs('public/document/upload',$dog->id.$v.'.pdf');
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

        // Cancel the previous list of vaccinations
        $prevVaccination = $dog->vaccination;
        foreach($prevVaccination as $prev) {
            $dog->vaccination()->detach($prev->id);
        }

        $dog->save();

        // Update the list of vaccination --> preferisco modificarla quando inseriamo una nuova vaccinaizone
        /*
        foreach($vaccinations as $v) {
            $dog->vaccination()->attach($v);
        }*/
        // massive update (only with fillable property enabled on Book): 
        // Book::find($id)->update(['title' => $title, 'author_id' => $author_id]);
    }

    
    // Aggiunge vaccinazione per cane
    public function addDogVaccination($dog_id,$vaccination_id,$data) {
       
       $vaccination=Vaccination::find($vaccination_id);
       $dog = Dog::find($dog_id);
       $dog->vaccination()->attach($vaccination,['data'=>$data]);
        
    }

    //Aggiunge adozione cane - utente
    public function addDogAdoption($dog_id,$user_id,$data) {
       // TODO!
         
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

     // restituisco i cani disponibili per l'adozione
     public function getDogAvailable(){
        return Dog::doesntHave('adoption')->get();
 
     }

     public function addUser($name, $password, $email) {
        $user = new User();
        $user->name = $name;
        $user->password = md5($password);
        $user->email = $email;
        $user->save();
    }
    
    public function getUserID($username) {
        $users = User::where('email',$username)->get(['id']);
        return $users[0]->id;
    }

}
