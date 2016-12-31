@extends('base')

@section('content')
<h3>{{ $news->title }}</h3>
<p class="text-muted">
  @svg (calendar-o)
  {{ $news->created_at->formatLocalized('%e %B %Y') }}
</p>
{!! $news->html !!}
@endsection
