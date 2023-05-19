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
        foreach($vaccination as $v) {
            $dog->vaccination()->detach($v->id);
        }
        $dog->delete();
    }

    public function uploadImage($image,$dog){
        $filename = $image;
        echo $filename;
    $tempname = $image;
    $folder = "img/upload" . $filename;
 
    $db = mysqli_connect("localhost", "marco", "marco", "canile");
 
    // Get all the submitted data from the form
    //$sql = "INSERT INTO image (filename) VALUES ('$filename','$dog->id')";
 
    // Execute query
    //mysqli_query($db, $sql);
 
    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>  Image uploaded successfully!</h3>";
    } else {
        echo "<h3>  Failed to upload image!</h3>";
    }

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

    if(is_array($images)){
        foreach($images as $i){
            $this->uploadImage($i,$dog);
        }
    }
    else{
        $this->uploadImage($images,$dog);
    }

    $dog->save();
    }


    public function getAllVaccinations() {
       return Vaccination::orderBy('malattia','asc')->get();
    }   

    public function getDogImages($id)
    {
        $dog = Dog::find($id);
        return $dog->image;
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

        if(is_array($images)){
            foreach($images as $i){
                $this->uploadImage($i,$dog);
            }
        }
        else{
            echo $images;
            //$this->uploadImage($images,$dog);
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
        print($email);
         //prendo l'utente con la mail specificata
        $users = User::where('email',$email)->get(['password']);
        print($users);
        if(count($users) == 0)
        {
            return false;
        }
        //ha inserito psw corretta?
        return (md5($password) == ($users[0]->password));
     }
 
     public function getUserName($email){
         $users=User::where('email',$email)->get();
         return $users[0]->name;
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
