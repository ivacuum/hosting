{{-- Комментарий к новости --}}
<strong>{{ $notification->data['comment']['user']['name'] }}</strong>
<span class="text-muted">@lang("ui.notifications.{$basename}")</span>
<a class="link" href="{{ path([App\Http\Controllers\NewsController::class, 'show'], $notification->data['id']) }}#comment-{{ $notification->data['comment']['id'] }}">{{ Str::limit($notification->data['title'], 101) }}</a>
<time
  class="text-muted"
  datetime="{{ $notification->created_at->toDateString() }}"
  title="{{ $notification->created_at->toAtomString() }}"
>{{ $notification->created_at->diffForHumans() }}</time>
<div class="mt-1">{!! $notification->data['comment']['html'] !!}</div>
