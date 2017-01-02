@extends('base')

@section('content')
@if (sizeof($news))
  <div class="row">
    <div class="col-md-8">
      @foreach ($news as $model)
        <h3><a class="link" href="{{ action("$self@show", $model->urlParams()) }}">{{ $model->title }}</a></h3>
        <p class="text-muted">
          @svg (calendar-o)
          {{ $model->created_at->formatLocalized('%e %B %Y') }}
          &nbsp;
          @svg (eye)
          {{ ViewHelper::number($model->views) }}
        </p>
        <div class="m-b-3">{!! $model->html !!}</div>
      @endforeach
    </div>
  </div>

  <div class="m-t-1 pull-right clearfix">
    @include('tpl.paginator', ['paginator' => $news])
  </div>
@else
  <p>По данным критериям новости не найдены.</p>
@endif

@endsection
