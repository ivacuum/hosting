@extends('gallery.base')
@include('livewire')

@section('content')
@livewire(App\Http\Livewire\GalleryUploader::class)
@endsection
