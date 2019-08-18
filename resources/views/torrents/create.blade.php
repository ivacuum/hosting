@extends('torrents.base')

@section('content')
<div class="row">
  <div class="col-lg-6">
    <form action="{{ path("$self@store") }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}
      @csrf

      @include("$tpl.form")

      <button class="btn btn-primary">
        {{ trans("$tpl.create") }}
      </button>
    </form>
  </div>
  <div class="col-lg-6 tw-mt-6 mt-lg-0">
    @ru
      <div>Нашли что-то интересное на рутрекере? Поделитесь своей находкой со всеми! Достаточно выбрать подходящую рубрику и вставить ссылку на раздачу. Далее сайт все сделает автоматически — вам даже не нужно скачивать, хэшировать или поддерживать раздачу. Так просто еще никогда не было!</div>
    @endru
  </div>
</div>
@endsection
