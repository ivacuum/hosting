@extends('acp.dev.base')
@include('livewire')

@section('content')
<h2 class="font-medium text-3xl mb-2">Создание миниатюр</h2>
@livewire(App\Livewire\ThumbnailMaker::class)

<a class="btn btn-default mt-6" href="@lng/dev/thumbnails/clean">Почистить папку с загруженными файлами</a>
@endsection
