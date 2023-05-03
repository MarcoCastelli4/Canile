<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Dog;
use App\Models\Vaccination;
use App\Models\Review;
use App\Models\Document;

use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * 
     */
    public function run()
    {
        
       // applica la factory di cane per 10 volte
       Dog::factory()->count(10)->create();

       //applica la factory di trattamento per 10 volte
       Vaccination::factory()->count(10)->create();

      

      
       // ad ogni cane selezionato do una vaccinazione
      /* FUNZIONA
        foreach(Dog::all() as $dog){
          foreach(Food::all() as $food){
            $dog->food()->attach($food,['data'=>Carbon::today()->subDays(rand(0, 365))]);
          }
        }  
       

        /* NON VA
        $randomDog = [array_rand(json_decode(Dog::all()), 5)];
        foreach($randomDog as $dog){
          $randomT = [array_rand(json_decode(Treatments::all()), 2)];
          foreach($randomT as $treat){
            
           $dog->treatments()->attach($treat,['data'=>Carbon::today()->subDays(rand(0, 365))]);
        }
      }

      $dog_list= json_decode(Dog::all());
      for($i=0; $i<2; $i++){
        $dog=$dog_list[array_rand($dog_list)];
        $treatments_list= json_decode(Treatments::all());
        for($j=0;$j<2;$j++){
          $treat=$treatments_list[array_rand($treatments_list)];
          $dog->treatments()->attach($treat,['data'=>Carbon::today()->subDays(rand(0, 365))]);
        }
      }*/


      //una vaccinazione per ogni cane
      foreach(Vaccination::all() as $v){
        foreach(Dog::all() as $dog){
          $dog->vaccination()->attach($v,['data'=>Carbon::today()->subDays(rand(0, 365))]);
        }
      }  
}
}
