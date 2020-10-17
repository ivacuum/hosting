@extends('korean.base')
@include('livewire')

@section('content')
<h1 class="text-3xl">@lang('meta_title.korean/hangul')</h1>
<p>Как можно заметить, клавиатура поделена на две части. В левой половине согласные, а в правой — гласные.</p>

@livewire(App\Http\Livewire\HangulTrainer::class)
@endsection
