@extends('base')
@include('livewire')

@section('content')
<h1>Base64 Encoder</h1>
@livewire(App\Http\Livewire\Base64Encoder::class)
@endsection
