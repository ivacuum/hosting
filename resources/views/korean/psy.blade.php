@extends('life.base', [
  'noLanguageSelector' => true,
])

@section('content')
<h1 class="font-medium text-3xl tracking-tight mb-2">Кириллизация песен PSY</h1>
@ru
  <p>Готовый набор для подготовки к концертам. Мечтал о таком, когда впервые задумал посетить шоу. Все перечисленные песни исполнялись <a class="link" href="/life/psy.2018">с 2018 года</a>.</p>
@endru
<ol class="pl-8">
  @foreach ($songs as $song)
    <li>
      <a class="link" href="{{ $song['link'] }}">
        {{ $song['title'] }}
      </a>
    </li>
  @endforeach
</ol>
@endsection
