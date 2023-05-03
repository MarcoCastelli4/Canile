<?php

namespace App\Models;


class DataLayer {
    public function listDogs(){

        //restituisco la lista di tutti i cani ordinati prima per cognome e poi per nome
       return Dog::orderBy('nome','asc')->orderBy('razza','asc')->get();

   }

   
}
