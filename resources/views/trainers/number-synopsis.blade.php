@extends('life.base')
@include('livewire')

@section('content')
<div>
  <h1 class="font-medium text-2xl mb-2">@lang('Краткий обзор')</h1>
  @ru
    <p>С помощью данной сводки можно самостоятельно обнаружить принципы составления чисел на выбранном языке.</p>
  @en
    <p>Using this summary, you can discover number formation principles of the selected language on your own.</p>
  @endru
</div>
@livewire(App\Http\Livewire\NumberSynopsis::class)
@endsection
