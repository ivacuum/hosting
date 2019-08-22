@extends('life.base', [
  'meta_title' => 'Понравившиеся книги',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Понравившиеся книги'],
  ]
])

@section('content')
<h1 class="h2">Понравившиеся книги</h1>

<div class="tw-flex tw-mb-2">
  <div>
    <div class="tw-font-bold travel-year">2014</div>
  </div>
  <div>
    <div><a class="link" href="https://www.ozon.ru/context/detail/id/28788268/">Марсианин</a></div>
  </div>
</div>

<div class="tw-flex tw-mb-2">
  <div>
    <div class="tw-font-bold travel-year">2013</div>
  </div>
  <div>
    <div><a class="link" href="https://www.ozon.ru/context/detail/id/19728054/">11/22/63</a></div>
  </div>
</div>
@endsection
