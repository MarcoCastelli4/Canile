@extends('layouts.master') 

@section('titolo')
Canile
@endsection

@section('stile','style.css') 

@section('left_navbar')
<li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('home')}}">Home Page</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('dog.index')}}">Tutti i cani</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Adozioni</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Salute dei cani</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Recensioni</a>
                  </li>
                  
@endsection

@section('corpo')

                <div class="col-sm-9">
                    
                        <p>Nata più di  25 anni fa, inizialmente con lo scopo di ricoverare i cani persi 
                          o randagi ritrovati nel territorio del comune di Darfo Boario Terme (BS) e poi, passo dopo passo, 
                          la nostra attività si è allargata alla protezione e cura delle colonie feline presenti sul 
                          territorio, la loro sterilizzazione, interventi di sensibilizzazione nelle scuole contro 
                          l'abbandono di animali domestici e per la tutela ed il benessere animale.
                        </p>        
                </div>
                <div class="col-sm-3">
                    
                  <img src="img/dog.jpg" class="img-thumbnail img-responsive">
                    
                </div>
                <br/><br/><br/><br/>
                <h2>Dove siamo</h2>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22220.48314592023!2d10.1595469!3d45.8801041!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4783db65ed357cc7%3A0x349e60c5818d30a8!2sParco%20del%20Lago%20Moro!5e0!3m2!1sit!2sit!4v1680350393838!5m2!1sit!2sit" 
                width="30" height="400" style="float: right;" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div><!-- /.row -->
            <br/>
            <br/>
           
            <div class="servizi">
              <div class="center">I NOSTRI SERVIZI</div>  
             </div>
             <br/>
            <br/>

              <div class="list-service">
                <p style="text-align:center;">
                <div class="text-title">BENESSERE DELL'ANIMALE</div>
                <img src="img/logo1.jpg" class="img-responsive img-item">
                <br/>
                
                <p class="text">Conseguire il benessere animale attraverso la gestione della struttura rifugio</p>
                </p>
              </div>
             
              <br/>
              <br/>

              <div class="list-service">
                <div class="text-title">DIFFONDERE SENSIBILITA'</div>
                <img src="img/logo1.jpg" class="img-responsive img-item">
                <br/>
                
                <p class="text">Nei confronti degli animali che si basi sul rispetto e sull'empatia nei confronti delle altre specie viventi</p>
              </div>   
              
              <br/>
              <br/>
              
              <div class="list-service">
                <div class="text-title">SEMPLIFICARE LE ADOZIONI</div>
                <img src="img/logo1.jpg" class="img-responsive img-item">
                <br/>
                
                <p class="text"> Agevolare l’adozione degli animali, in particolare dei cani</p>
              </div>
        </div>

        <div class="colums">
          <div class="column">
            <br/><br/><br/><br/>
            <img src="img/logo.jpg" class="img-responsive" width="200"  height="200" >
          </div>

          <div class="column">
            <br/><br/><br/>
            </i> Canile Boscoverde<br/>
            Parco Del Lago Moro 25047 Darfo Boario Terme
            CF: 90049020093
            <br/><br/><br/>
            <i class="bi bi-telephone">&nbsp+39 0364 331944</i>
            <br/>
            <br/>
            <i class="bi bi-envelope-fill">&nbspCanileBoscoverde@email.com</i>
          </div>

          <div class="column">
            <br/>
            Seguici su:
            <br/>
            <i class="bi bi-facebook" style="font-size: 50px;">
              &nbsp
            </i><i class="bi bi-instagram" style="font-size: 50px;"></i>

            <br/>
            <br/>
            Orario:
            <br/>
            Lunedì: 10-14
            <br/>
            Martedi: 10-18
            <br/>
            Mercoledì: chiuso
            <br/>
            Giovedì: 10-18
            <br/>
            Sabato: 12-18
            <br/>
            Domenica: chiuso

         
@endsection

