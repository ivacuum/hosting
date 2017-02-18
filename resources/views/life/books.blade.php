@extends('life.base', [
  'meta_title' => 'Понравившиеся книги',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Понравившиеся книги'],
  ]
])

@section('content')
<h1 class="h2 mt-0">Понравившиеся книги</h1>

<div class="travel-entry mb-2">
  <span class="travel-year">2014</span>
  <a class="link" href="http://www.ozon.ru/context/detail/id/28788268/">Марсианин</a>
</div>

<div class="travel-entry mb-2">
  <span class="travel-year">2013</span>
  <a class="link" href="http://www.ozon.ru/context/detail/id/19728054/">11/22/63</a>
</div>
@endsection
