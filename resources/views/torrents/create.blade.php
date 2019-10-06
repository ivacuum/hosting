@extends('torrents.base')

@section('content')
<div class="lg:flex lg:-mx-4">
  <div class="lg:w-1/2 lg:px-4">
    <form action="{{ path([App\Http\Controllers\Torrents::class, 'store']) }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}
      @csrf

      @include("$tpl.form")

      <button class="btn btn-primary">
        {{ trans("$tpl.create") }}
      </button>
    </form>
  </div>
  <div class="lg:w-1/2 lg:px-4 mt-6 lg:mt-0">
    @ru
      <div>Нашли что-то интересное на рутрекере? Поделитесь своей находкой со всеми! Достаточно выбрать подходящую рубрику и вставить ссылку на раздачу. Далее сайт все сделает автоматически — вам даже не нужно скачивать, хэшировать или поддерживать раздачу. Так просто еще никогда не было!</div>
    @endru
  </div>
</div>
@endsection
