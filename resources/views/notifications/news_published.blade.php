{{-- Опубликована новость --}}
@lang("ui.notifications.{$basename}")
<a class="link" href="{{ path([App\Http\Controllers\NewsController::class, 'show'], $notification->data['id']) }}">{{ Str::limit($notification->data['title'], 101) }}</a>
<time
  class="text-muted"
  datetime="{{ $notification->created_at->toDateString() }}"
  title="{{ $notification->created_at->toAtomString() }}"
>{{ $notification->created_at->diffForHumans() }}</time>
