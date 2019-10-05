@extends('base')

@section('content')
<h2>{{ trans('notifications.index') }}</h2>
@if (sizeof($notifications))
  <?php /** @var App\Notification $notification */ ?>
  @foreach ($notifications as $notification)
    <?php $classBasename = Str::snake(class_basename($notification->type)) ?>
    <div class="border-gray-200 py-4 {{ !$loop->last ? 'border-b' : '' }}">
      <div class="table-cell pr-4 svg-muted-blue text-xl">
        @if ($classBasename === 'torrent_updated')
          @svg (magnet)
        @elseif ($classBasename === 'torrent_not_found_deleted')
          @svg (trash-o)
        @elseif ($classBasename === 'trip_published')
          @svg (plane)
        @elseif (Str::endsWith($classBasename, '_commented'))
          @svg (comment-o)
        @else
          @svg (bullhorn)
        @endif
      </div>
      <div class="table-cell align-top">
        @if ($notification->unread())
          <span class="svg-unread mr-1 tooltipped tooltipped-n" aria-label="{{ trans('notifications.unread') }}">
            @svg (circle)
          </span>
        @endif
        @include("notifications.$classBasename")
      </div>
    </div>
  @endforeach
@else
  <p>{{ trans('notifications.zero') }}</p>
@endif
@endsection
