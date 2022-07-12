@extends('korean.base')
@include('livewire')

@section('content')
@livewire(App\Http\Livewire\HangulTrainer::class)
@endsection
