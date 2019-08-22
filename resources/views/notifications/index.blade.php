@extends('base')

@section('content')
<h2>{{ trans('notifications.index') }}</h2>
@if (sizeof($notifications))
  <div class="list-unstyled tw-mb-0">
    @foreach ($notifications as $notification)
      @php ($class_basename = snake_case(class_basename($notification->type)))
      <div class="tw-py-4 {{ !$loop->last ? 'border-bottom' : '' }}">
        <div class="tw-table-cell tw-pr-4 svg-muted-blue tw-text-xl">
          @if ($class_basename === 'torrent_updated')
            @svg (magnet)
          @elseif ($class_basename === 'torrent_not_found_deleted')
            @svg (trash-o)
          @elseif ($class_basename === 'trip_published')
            @svg (plane)
          @elseif (Illuminate\Support\Str::endsWith($class_basename, '_commented'))
            @svg (comment-o)
          @else
            @svg (bullhorn)
          @endif
        </div>
        <div class="tw-table-cell tw-align-top">
          @if ($notification->unread())
            <span class="svg-unread tw-mr-1 tooltipped tooltipped-n" aria-label="{{ trans('notifications.unread') }}">
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
