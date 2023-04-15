@extends('acp.show')

@section('content')
@if ($model->meta_image)
  <div class="mt-4">
    <img class="rounded image-fit-viewport" src="{{ $model->meta_image }}" alt="">
  </div>
@endif
<form class="mt-4" action="{{ to('acp/gigs/{gig}/notify', $model) }}" method="post">
  @csrf
  <button class="btn btn-default">@lang("$tpl.notify")</button>
</form>
@parent
@endsection
