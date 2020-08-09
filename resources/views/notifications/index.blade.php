@extends('base')

@section('content')
<h2>@lang('Уведомления')</h2>
@if (sizeof($notifications))
  <?php /** @var App\Notification $notification */ ?>
  @foreach ($notifications as $notification)
    <?php $basename = $notification->basename() ?>
    <div class="border-grey-200 py-4 {{ !$loop->last ? 'border-b' : '' }}">
      <div class="table-cell pr-4 svg-muted-blue text-xl">
        @if ($basename === 'torrent_updated')
          @svg (magnet)
        @elseif ($basename === 'torrent_not_found_deleted')
          @svg (trash-o)
        @elseif ($basename === 'trip_published')
          @svg (plane)
        @elseif (Str::endsWith($basename, '_commented'))
          @svg (comment-o)
        @else
          @svg (bullhorn)
        @endif
      </div>
      <div class="table-cell align-top">
        @if ($notification->unread())
          <span class="svg-unread mr-1 tooltipped tooltipped-n" aria-label="@lang('ui.notifications.unread')">
            @svg (circle)
          </span>
        @endif
        @include("notifications.$basename")
      </div>
    </div>
  @endforeach
@else
  <p>@lang('ui.notifications.zero')</p>
@endif
@endsection
