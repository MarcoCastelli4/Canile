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

    // cancellare un cane
    public function deleteDog($id) {
        $dog = Dog::find($id);
        $vaccination = $dog->vaccination;
        foreach($vaccination as $v) {
            $dog->vaccination()->detach($v->id);
        }
        $dog->delete();
    }

   // aggiungere un cane
   public function addDog($nome,$razza,$colore,$lunghezzapelo,$taglia,$sesso,$datanascita, $vaccinations) {
    $dog = new Dog;
    $dog->nome = $nome;
    $dog->razza = $razza;
    $dog->colore = $colore;
    $dog['lunghezza pelo']=$lunghezzapelo;
    $dog->taglia = $taglia;
    $dog->sesso = $sesso;
    $dog['data nascita']=$datanascita;
    $dog->save();
    foreach($vaccinations as $v) {
        $dog->vaccination()->attach($v);
    }
    }

    public function getAllVaccinations() {
       return Vaccination::orderBy('malattia','asc')->get();
    }   

    public function editDog($id, $nome,$razza,$colore,$lunghezzapelo,$taglia,$sesso,$datanascita, $vaccinations) {
        $dog = Dog::find($id);
        $dog->nome = $nome;
        $dog->razza = $razza;
        $dog->colore = $colore;
        $dog['lunghezza pelo']=$lunghezzapelo;
        $dog->taglia = $taglia;
        $dog->sesso = $sesso;
        $dog['data nascita']=$datanascita;
        $dog->save();

        // Cancel the previous list of vaccinations
        $prevVaccination = $dog->vaccination;
        foreach($prevVaccination as $prev) {
            $dog->vaccination()->detach($prev->id);
        }

        // Update the list of categories
        foreach($vaccinations as $v) {
            $dog->vaccination()->attach($v);
        }
        // massive update (only with fillable property enabled on Book): 
        // Book::find($id)->update(['title' => $title, 'author_id' => $author_id]);
    }
}
