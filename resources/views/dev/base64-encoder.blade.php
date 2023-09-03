@extends('base')
@include('livewire')

@section('content')
<h1 class="font-medium text-4xl tracking-tight mb-2">Base64 Encoder</h1>
@livewire(App\Livewire\Base64Encoder::class)
@endsection
