@extends('base')
@include('livewire')

@section('content')
<h1>Hash Generator</h1>
@livewire(App\Http\Livewire\HashGenerator::class)
@endsection
