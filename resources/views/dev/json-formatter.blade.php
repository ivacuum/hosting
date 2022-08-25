@extends('base')
@include('livewire')

@section('content')
<h1 class="font-medium text-4xl tracking-tight mb-2">Json Formatter</h1>
@livewire(App\Http\Livewire\JsonFormatter::class)
@endsection
