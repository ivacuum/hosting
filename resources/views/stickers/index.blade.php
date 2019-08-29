@extends('base')

@section('content')
<div class="h2 mb-6">@ru Стикеры @en Stickers @endru</div>

<div class="h3">
  @ru Акула @en It's a Shark @endru
  <a class="btn btn-success text-base" href="tg://addstickers?set=MrShark">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
@foreach (range(1, 40) as $i)
  <img class="inline-block" src="https://s.tcdn.co/887/736/8877364e-9bb8-306d-ae3a-1a49f15190ec/{{ $i }}.png" width="128" height="128">
@endforeach

<div class="h3 mt-12">
  @ru Ленивая панда @en Lazy Panda @endru
  <a class="btn btn-success text-base" href="tg://addstickers?set=LazyPanda">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
@foreach (range(1, 36) as $i)
  <img class="inline-block" src="https://s.tcdn.co/932/55d/93255d41-5636-3fb3-bbab-33835f24d937/{{ $i }}.png" width="128" height="128">
@endforeach

<div class="h3 mt-12">
  @ru Динозавры @en Dinosaurs @endru
  <a class="btn btn-success text-base" href="tg://addstickers?set=Mesozoic">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
@foreach (range(1, 40) as $i)
  <img class="inline-block" src="https://s.tcdn.co/990/349/9903498b-b760-3382-a71e-87d6d3e5c0e6/{{ $i }}.png"
  width="128" height="128">
@endforeach

<div class="h3 mt-12">
  @ru Чайка Джо @en Joe the Seagull @endru
  <a class="btn btn-success text-base" href="tg://addstickers?set=joe_the_seagull_ru">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
@foreach (range(1, 40) as $i)
  <img class="inline-block" src="https://s.tcdn.co/a82/ea3/a82ea393-a978-342f-b062-07823d877dae/{{ $i }}.png" width="128" height="128">
@endforeach

<div class="h3 mt-12">
  @ru Змея Снэки @en Sneaky Snakie @endru
  <a class="btn btn-success text-base" href="tg://addstickers?set=SneakySnakie">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
@foreach (range(1, 32) as $i)
  <img class="inline-block" src="https://s.tcdn.co/e4f/c33/e4fc33b9-128b-33c4-879a-d22ec27d2bd5/{{ $i }}.png" width="128" height="128">
@endforeach

{{--
ItsVacationTime
--}}
@endsection
