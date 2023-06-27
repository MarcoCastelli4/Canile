@component('mail::message')

Gentile {{$name}} La tua adozione è avvenuta con successo!
<br>
Questi i dettagli del tuo amico a quattro zampe:
<br>
Nome: {{$dog->nome}}<br>
Razza: {{$dog->razza}}<br>
Colore: {{$dog->colore}}<br>
Dimensioni: {{$dog->taglia}}<br>
Sesso: {{$dog->sesso}}<br>
Data di nascita: {{$dog['data nascita']}}<br>

<br> <strong>Ha tempo fino a una settimana per ritirare il cane! </strong>
<br>
Risponda a questa mail se dovessi avere problemi! Saremo molto disponibili e gentili con lei che ha deciso di fare del bene adottando dal nostro canile!

@component('mail::button',['url'=>'http://127.0.0.1:8000'])
Canile Boscoverde
@endcomponent

@endcomponent