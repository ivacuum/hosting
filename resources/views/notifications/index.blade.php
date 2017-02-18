@extends('base')

@section('content')
<h2 class="mt-0">{{ trans('notifications.index') }}</h2>
@if (sizeof($notifications))
  <ul class="list-unstyled mb-0">
    @foreach ($notifications as $notification)
      @php ($class_basename = snake_case(class_basename($notification->type)))
      <li class="py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
        <div class="d-table-cell pr-3 svg-muted-blue f20 svg-mt-0">
          @if ($class_basename === 'torrent_updated')
            @svg (magnet)
          @elseif ($class_basename === 'trip_published')
            @svg (plane)
          @elseif (ends_with($class_basename, '_commented'))
            @svg (comment-o)
          @else
            @svg (bullhorn)
          @endif
        </div>
        <div class="d-table-cell align-top">
          @if ($notification->unread())
            <span class="svg-unread mr-1 tooltipped tooltipped-n" aria-label="{{ trans('notifications.unread') }}">
              @svg (circle)
            </span>
          @endif
          @include("notifications.$class_basename")
          <div class="f13 text-muted">
            <time datetime="{{ $notification->created_at->toDateString() }}"
                  title="{{ $notification->created_at->toAtomString() }}">
              {{ $notification->created_at->diffForHumans() }}
            </time>
          </div>
        </div>
      </li>
    @endforeach
  </ul>
@else
  <p>{{ trans('notifications.zero') }}</p>
@endif
@endsection
