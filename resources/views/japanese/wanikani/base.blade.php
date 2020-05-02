@extends('japanese.base')
@include('livewire')

@section('content_header')
@livewire(App\Http\Livewire\WanikaniSearch::class)
@endsection
