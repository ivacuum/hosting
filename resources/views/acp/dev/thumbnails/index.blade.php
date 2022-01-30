@extends('acp.dev.base')
@include('livewire')

@section('content')
<h2>Создание миниатюр</h2>
@livewire(App\Http\Livewire\ThumbnailMaker::class)

<a class="btn btn-default mt-6" href="{{ path([$controller, 'clean']) }}">Почистить папку с загруженными файлами</a>
@endsection
