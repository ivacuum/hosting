@extends('base')
@include('livewire')

@section('content')
<h1>Base64 Decoder</h1>
@livewire(App\Http\Livewire\Base64Decoder::class)
@endsection
