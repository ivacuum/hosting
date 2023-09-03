@extends('japanese.base')
@include('livewire')

@section('content_header')
@livewire(App\Livewire\WanikaniSearch::class)
@endsection
