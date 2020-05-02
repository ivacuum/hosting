@extends('japanese.wanikani.base')

@section('content')
<h1 class="h2">{{ trans('japanese.levels') }}</h1>
<div class="flex flex-wrap items-center">
  @foreach (range(1, 60) as $level)
    <a
      class="flex bg-grey-600 hover:bg-grey-700 text-white hover:text-grey-100 px-2 text-lg font-bold rounded mr-2 mb-2"
      href="{{ path(App\Http\Controllers\WanikaniLevelController::class, $level) }}"
    >
      {{ $level }}
    </a>
  @endforeach
</div>
@endsection
