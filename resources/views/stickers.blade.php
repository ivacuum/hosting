@extends('base')

@section('content')
<div class="font-medium text-3xl tracking-tight mb-6">@ru Стикеры @en Stickers @endru</div>

<div class="flex gap-2 justify-between md:justify-start items-center mb-3">
  <div class="font-medium text-2xl mb-2">
    @ru Акула @en It's a Shark @endru
  </div>
  <a class="btn btn-success" href="tg://addstickers?set=MrShark">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
<div class="grid overflow-x-scroll" style="grid-template-columns: repeat(40, 128px); grid-template-rows: 128px;">
  @foreach (range(1, 40) as $i)
    <img class="w-32 h-32" src="https://s.tcdn.co/887/736/8877364e-9bb8-306d-ae3a-1a49f15190ec/{{ $i }}.png" alt="">
  @endforeach
</div>

<div class="flex gap-2 justify-between md:justify-start items-center mb-3 mt-12">
  <div class="font-medium text-2xl mb-2">
    @ru Ленивая панда @en Lazy Panda @endru
  </div>
  <a class="btn btn-success" href="tg://addstickers?set=LazyPanda">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
<div class="grid overflow-x-scroll" style="grid-template-columns: repeat(36, 128px); grid-template-rows: 128px;">
  @foreach (range(1, 36) as $i)
    <img class="w-32 h-32" src="https://s.tcdn.co/932/55d/93255d41-5636-3fb3-bbab-33835f24d937/{{ $i }}.png" alt="">
  @endforeach
</div>

<div class="flex gap-2 justify-between md:justify-start items-center mb-3 mt-12">
  <div class="font-medium text-2xl mb-2">
    @ru Динозавры @en Dinosaurs @endru
  </div>
  <a class="btn btn-success" href="tg://addstickers?set=Mesozoic">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
<div class="grid overflow-x-scroll" style="grid-template-columns: repeat(40, 128px); grid-template-rows: 128px;">
  @foreach (range(1, 40) as $i)
    <img class="w-32 h-32" src="https://s.tcdn.co/990/349/9903498b-b760-3382-a71e-87d6d3e5c0e6/{{ $i }}.png" alt="">
  @endforeach
</div>

<div class="flex gap-2 justify-between md:justify-start items-center mb-3 mt-12">
  <div class="font-medium text-2xl mb-2">
    @ru Чайка Джо @en Joe the Seagull @endru
  </div>
  <a class="btn btn-success" href="tg://addstickers?set=joe_the_seagull_ru">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
<div class="grid overflow-x-scroll" style="grid-template-columns: repeat(40, 128px); grid-template-rows: 128px;">
  @foreach (range(1, 40) as $i)
    <img class="w-32 h-32" src="https://s.tcdn.co/a82/ea3/a82ea393-a978-342f-b062-07823d877dae/{{ $i }}.png" alt="">
  @endforeach
</div>

<div class="flex gap-2 justify-between md:justify-start items-center mb-3 mt-12">
  <div class="font-medium text-2xl mb-2">
    @ru Змея Снэки @en Sneaky Snakie @endru
  </div>
  <a class="btn btn-success" href="tg://addstickers?set=SneakySnakie">@ru Добавить в Телеграм @en Add to Telegram @endru</a>
</div>
<div class="grid overflow-x-scroll" style="grid-template-columns: repeat(32, 128px); grid-template-rows: 128px;">
  @foreach (range(1, 32) as $i)
    <img class="w-32 h-32" src="https://s.tcdn.co/e4f/c33/e4fc33b9-128b-33c4-879a-d22ec27d2bd5/{{ $i }}.png" alt="">
  @endforeach
</div>

{{--
ItsVacationTime
--}}
@endsection
