@extends('base')
@include('livewire')

@section('content')
<h1>Json Formatter</h1>
@livewire(App\Http\Livewire\JsonFormatter::class)
@endsection
