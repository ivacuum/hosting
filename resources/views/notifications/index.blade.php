@extends('base')

@section('content')
<h2>{{ trans('notifications.index') }}</h2>
@if (sizeof($notifications))
  <div class="list-unstyled mb-0">
    @foreach ($notifications as $notification)
      @php ($class_basename = snake_case(class_basename($notification->type)))
      <div class="py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
        <div class="d-table-cell pr-3 svg-muted-blue f20 svg-mt-0">
          @if ($class_basename === 'torrent_updated')
            @svg (magnet)
          @elseif ($class_basename === 'torrent_not_found_deleted')
            @svg (trash-o)
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
        </div>
      </div>
    @endforeach
  </div>
@else
  <p>{{ trans('notifications.zero') }}</p>
@endif
@endsection
