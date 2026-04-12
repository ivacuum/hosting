@extends('base')

@section('content')
<h1 class="font-medium text-4xl tracking-tight mb-2">EXIF Reader</h1>
@livewire(App\Domain\Exif\Livewire\ExifReader::class)
@endsection
