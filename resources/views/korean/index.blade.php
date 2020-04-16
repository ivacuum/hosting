@extends('life.base', [
  'noLanguageSelector' => true,
])

@section('content')
<h1 class="text-3xl">{{ trans('meta_title.korean') }}</h1>
@ru
  <p><a class="link" href="{{ path(App\Http\Controllers\KoreanPsyController::class) }}">Кириллизация песен PSY</a></p>
@endru
@endsection
