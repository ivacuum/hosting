@extends('base')

@section('content')
<h2 class="m-t-0">{{ trans('notifications.index') }}</h2>
@if (sizeof($notifications))
  <ul class="list-unstyled">
    @foreach ($notifications as $notification)
      @php ($class_basename = snake_case(class_basename($notification->type)))
      <li class="p-y-1 border-bottom">
        <div class="d-table-cell p-r-1 svg-muted-blue">
          @if ($class_basename === 'torrent_updated')
            @svg (magnet)
          @else
            @svg (bullhorn)
          @endif
        </div>
        <div class="d-table-cell">
          @if ($class_basename === 'plain_text')
            {{ $notification->data['text'] }}
          @elseif ($class_basename === 'torrent_updated')
            {{ trans("notifications.{$class_basename}") }}
            <a class="link" href="{{ action('Torrents@torrent', $notification->data['id']) }}">{{ str_limit($notification->data['title'], 100) }}</a>
          @endif
          <div class="f13 text-muted">
            <time datetime="{{ $notification->created_at->toDateString() }}"
                  title="{{ $notification->created_at->toAtomString() }}">
              {{ $notification->created_at->diffForHumans() }}
            </time>
            @if (is_null($notification->read_at))
              &middot;
              <span class="text-warning">{{ trans('notifications.unread') }}</span>
            @endif
          </div>
        </div>
      </li>
    @endforeach
  </ul>
@else
  <p>{{ trans('notifications.zero') }}</p>
@endif
@endsection
