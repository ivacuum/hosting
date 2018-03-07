@extends('base')

@section('content')
<div class="h2 mb-4">@ru Стикеры @en Stickers @endru</div>

<div class="h3">
  @ru Акула @en It's a Shark @endru
  <a class="btn btn-success" href="tg://addstickers?set=MrShark">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
@foreach (range(1, 40) as $i)
  <img class="d-inline-block" src="https://s.tcdn.co/887/736/8877364e-9bb8-306d-ae3a-1a49f15190ec/{{ $i }}.png" width="128">
@endforeach

<div class="h3 mt-5">
  @ru Ленивая панда @en Lazy Panda @endru
  <a class="btn btn-success" href="tg://addstickers?set=LazyPanda">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
@foreach (range(1, 36) as $i)
  <img class="d-inline-block" src="https://s.tcdn.co/932/55d/93255d41-5636-3fb3-bbab-33835f24d937/{{ $i }}.png" width="128">
@endforeach

<div class="h3 mt-5">
  @ru Динозавры @en Dinosaurs @endru
  <a class="btn btn-success" href="tg://addstickers?set=Mesozoic">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
@foreach (range(1, 40) as $i)
  <img class="d-inline-block" src="https://s.tcdn.co/990/349/9903498b-b760-3382-a71e-87d6d3e5c0e6/{{ $i }}.png"
  width="128">
@endforeach

<div class="h3 mt-5">
  @ru Чайка Джо @en Joe the Seagull @endru
  <a class="btn btn-success" href="tg://addstickers?set=joe_the_seagull_ru">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
@foreach (range(1, 40) as $i)
  <img class="d-inline-block" src="https://s.tcdn.co/a82/ea3/a82ea393-a978-342f-b062-07823d877dae/{{ $i }}.png" width="128">
@endforeach

{{--
ItsVacationTime
--}}
@endsection
