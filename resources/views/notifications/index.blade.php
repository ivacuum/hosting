@extends('base')

@section('content')
<h2 class="font-medium text-3xl tracking-tight mb-2">@lang('Уведомления')</h2>
@if (count($notifications))
  <?php /** @var App\Notification $notification */ ?>
  @foreach ($notifications as $notification)
    <?php $basename = $notification->basename() ?>
    <div class="border-grey-200 py-4 {{ !$loop->last ? 'border-b' : '' }}">
      <div class="table-cell pr-4 svg-muted-blue text-xl">
        @if ($basename === 'magnet_updated')
          @svg (magnet)
        @elseif ($basename === 'trip_published')
          @svg (plane)
        @elseif (str_ends_with($basename, '_commented'))
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
