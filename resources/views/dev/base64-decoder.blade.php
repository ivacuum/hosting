@extends('base')
@include('livewire')

@section('content')
<h1 class="font-medium text-4xl tracking-tight mb-2">Base64 Decoder</h1>
@livewire(App\Livewire\Base64Decoder::class)
@endsection
