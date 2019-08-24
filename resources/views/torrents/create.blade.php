@extends('torrents.base')

@section('content')
<div class="lg:tw-flex lg:tw--mx-4">
  <div class="lg:tw-w-1/2 lg:tw-px-4">
    <form action="{{ path("$self@store") }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}
      @csrf

      @include("$tpl.form")

      <button class="btn btn-primary">
        {{ trans("$tpl.create") }}
      </button>
    </form>
  </div>
  <div class="lg:tw-w-1/2 lg:tw-px-4 tw-mt-6 lg:tw-mt-0">
    @ru
      <div>Нашли что-то интересное на рутрекере? Поделитесь своей находкой со всеми! Достаточно выбрать подходящую рубрику и вставить ссылку на раздачу. Далее сайт все сделает автоматически — вам даже не нужно скачивать, хэшировать или поддерживать раздачу. Так просто еще никогда не было!</div>
    @endru
  </div>
</div>
@endsection
