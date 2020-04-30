@extends('acp.show')

@section('content')
@if ($model->meta_image)
  <div class="mt-4">
    <img class="rounded image-fit-viewport" src="{{ $model->meta_image }}" alt="">
  </div>
@endif
<form class="mt-4" action="{{ path(App\Http\Controllers\Acp\GigPublishedNotify::class, $model) }}" method="post">
  @csrf
  <button class="btn btn-default">{{ trans("$tpl.notify") }}</button>
</form>
@parent
@endsection
