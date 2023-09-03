@extends('gallery.base')
@include('livewire')

@section('content')
@livewire(App\Livewire\GalleryUploader::class)
@endsection
