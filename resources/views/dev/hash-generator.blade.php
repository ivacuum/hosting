@extends('base')
@include('livewire')

@section('content')
<h1 class="font-medium text-4xl tracking-tight mb-2">Hash Generator</h1>
@livewire(App\Http\Livewire\HashGenerator::class)
@endsection
