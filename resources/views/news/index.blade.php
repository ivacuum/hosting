@extends('base')

@section('content')
@if (sizeof($news))
  <div class="row">
    <div class="col-md-8">
      @foreach ($news as $model)
        <h3><a class="link" href="{{ action("$self@show", $model->urlParams()) }}">{{ $model->title }}</a></h3>
        <p class="text-muted">
          <span class="mr-1 svg-muted">
            @svg (calendar-o)
          </span>
          {{ $model->created_at->formatLocalized('%e %B %Y') }}
          @if (!is_null($model->user) && $model->user->login)
            <span class="ml-3 mr-1 svg-muted">
              @svg (pencil)
            </span>
            {{ $model->user->login }}
          @endif
          <span class="ml-3 mr-1 svg-muted">
            @svg (eye)
          </span>
          {{ ViewHelper::number($model->views) }}
          @if ($model->comments_count)
            <span class="ml-3 mr-1 svg-muted">
              @svg (comment-o)
            </span>
            {{ ViewHelper::number($model->comments_count) }}
          @endif
        </p>
        <div class="mb-5 hidden-xs">{!! $model->html !!}</div>
      @endforeach
    </div>
  </div>

  <div class="mt-1 pull-right clearfix">
    @include('tpl.paginator', ['paginator' => $news])
  </div>
@else
  <p>По данным критериям новости не найдены.</p>
@endif

@endsection
