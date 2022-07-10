@extends('base')
@include('livewire')

@section('content')
@livewire(App\Http\Livewire\NumberTrainer::class)
@endsection
