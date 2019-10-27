{{-- Опубликована новость --}}
{{ trans("notifications.{$basename}") }}
<a class="link" href="{{ path([App\Http\Controllers\News::class, 'show'], $notification->data['id']) }}">{{ Str::limit($notification->data['title'], 100) }}</a>
<time
  class="text-muted"
  datetime="{{ $notification->created_at->toDateString() }}"
  title="{{ $notification->created_at->toAtomString() }}"
>{{ $notification->created_at->diffForHumans() }}</time>
