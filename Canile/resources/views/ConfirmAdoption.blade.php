@component('mail::message')

Great {{$name}} your adoption is confirmed!
<br>
This is the details about adoption:
<br>
Dog name: {{$dog->nome}}<br>
Dog race: {{$dog->razza}}<br>
Dog colour: {{$dog->colore}}<br>
Dog dimension: {{$dog->taglia}}<br>
Dog sex: {{$dog->sesso}}<br>
Dog birthday: {{$dog['data nascita']}}<br>

@component('mail::button',['url'=>'http://127.0.0.1:8000'])
Canile Boscoverde
@endcomponent

@endcomponent