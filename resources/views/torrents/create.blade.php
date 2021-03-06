@extends('torrents.base')

@section('content')
<div class="grid lg:grid-cols-2 gap-8">
  <div>
    <form action="@lng/torrents" method="post">
      {{ ViewHelper::inputHiddenMail() }}
      @csrf

      @include('torrents.form')

      <button class="btn btn-primary">
        @lang('Добавить раздачу')
      </button>
    </form>
  </div>
  <div>
    @ru
      <div>Нашли что-то интересное на рутрекере? Поделитесь своей находкой со всеми! Достаточно выбрать подходящую рубрику и вставить ссылку на раздачу. Далее сайт все сделает автоматически — вам даже не нужно скачивать, хэшировать или поддерживать раздачу. Так просто еще никогда не было!</div>
    @endru
  </div>
</div>
@endsection
