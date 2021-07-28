{{-- Опубликована заметка о поездке --}}
@lang("ui.notifications.{$basename}")
<a
  class="link"
  href="{{ path([App\Http\Controllers\Life::class, 'page'], $notification->data['slug']) }}"
>{{ Str::limit($notification->data['title'], 101) }}</a>
<time
  class="text-muted"
  datetime="{{ $notification->created_at->toDateString() }}"
  title="{{ $notification->created_at->toAtomString() }}"
>{{ $notification->created_at->diffForHumans() }}</time>
