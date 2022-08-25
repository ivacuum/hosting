@extends('life.base')

@section('content')
<h1 class="font-medium text-3xl tracking-tight mb-2">@lang('Понравившиеся книги')</h1>

<div class="flex gap-3 mb-2">
  <div>
    <div class="sticky top-2 font-bold">2021</div>
  </div>
  <div>
    <div><a class="link" href="https://www.amazon.com/Design-Everyday-Things-Revised-Expanded/dp/0465050654">The Design of Everyday Things</a></div>
  </div>
</div>

<div class="flex gap-3 mb-2">
  <div>
    <div class="sticky top-2 font-bold">2014</div>
  </div>
  <div>
    <div><a class="link" href="https://www.ozon.ru/context/detail/id/28788268/">Марсианин</a></div>
  </div>
</div>

<div class="flex gap-3 mb-2">
  <div>
    <div class="sticky top-2 font-bold">2013</div>
  </div>
  <div>
    <div><a class="link" href="https://www.ozon.ru/context/detail/id/19728054/">11/22/63</a></div>
  </div>
</div>
@endsection
