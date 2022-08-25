@extends('acp.dev.base')
@include('livewire')

@section('content')
<h2 class="font-medium text-3xl mb-2">Создание миниатюр</h2>
@livewire(App\Http\Livewire\ThumbnailMaker::class)

<a class="btn btn-default mt-6" href="{{ path([App\Http\Controllers\Acp\Dev\Thumbnails::class, 'clean']) }}">Почистить папку с загруженными файлами</a>
@endsection
