@extends('acp.dev.base')

@section('content')
<h2 class="font-medium text-3xl mb-2">Создание миниатюр</h2>
@livewire(App\Livewire\ThumbnailMaker::class)

<form method="POST" action="{{ to('acp/dev/thumbnails/clean') }}">
  @csrf
  @method('DELETE')
  <button class="btn btn-default mt-6" type="submit">Почистить папку с загруженными файлами</button>
</form>
@endsection
