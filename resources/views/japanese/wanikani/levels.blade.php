@extends('japanese.wanikani.base')

@section('content')
<h1 class="font-medium text-3xl tracking-tight mb-2">@lang('Уровни')</h1>
<div class="flex flex-wrap gap-2 items-center">
  @foreach (range(1, 60) as $level)
    <a
      class="flex bg-grey-600 hover:bg-grey-700 text-white hover:text-grey-100 px-2 text-lg font-bold rounded"
      href="{{ path(App\Http\Controllers\WanikaniLevel::class, $level) }}"
    >
      {{ $level }}
    </a>
  @endforeach
</div>
@endsection
