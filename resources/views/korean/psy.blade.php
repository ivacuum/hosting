@extends('life.base', [
  'noLanguageSelector' => true,
])

@section('content')
<h1 class="text-3xl leading-tight">Кириллизация песен PSY</h1>
@ru
  <p>Готовый набор для подготовки к концертам. Мечтал о таком, когда впервые задумал посетить шоу. Все перечисленные песни исполнялись с 2018 года.</p>
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
