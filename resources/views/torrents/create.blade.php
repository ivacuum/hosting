@extends('torrents.base')

@section('content')
<div class="row">
  <div class="col-md-6">
    <form class="mb-3" action="{{ path("$self@store") }}" method="post">

      @include("$tpl.form")

      <button class="btn btn-primary">
        {{ trans("$tpl.create") }}
      </button>

      {{ csrf_field() }}
    </form>
  </div>
  <div class="col-md-6">
    @ru
      <div>Нашли что-то интересное на рутрекере? Поделитесь своей находкой со всеми! Достаточно выбрать подходящую рубрику и вставить ссылку на раздачу. Далее сайт все сделает автоматически — вам даже не нужно скачивать, хэшировать или поддерживать раздачу. Так просто еще никогда не было!</div>
    @endru
  </div>
</div>
@endsection
