@extends('life.trips.base')

@section('content')
@ru
  <p>Краткосрочный визит на <a class="link" href="metallica.2008">концерт Металлики</a>. С тех пор понял, что в купе на поезде ехать стоит только в крайнем случае. В пересчете на доллары билет туда-обратно в то время стоил около $200. Даже билет на концерт в фан-зону обошелся почти вдвое дешевле.</p>
  {{--
  <p>Водители принимают оплату, говорят спасибо за оплату без сдачи.</p>
  <p>Куда более спокойный город, нежели Москва. Это ощущается, например, в метро.</p>
  --}}
@endru
@include('tpl.pic', ['pic' => 'IMG_1144.jpg'])
@endsection
