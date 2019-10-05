{{-- Опубликована заметка о поездке --}}
{{ trans("notifications.{$classBasename}") }}
<a
  class="link"
  href="{{ path('Life@page', $notification->data['slug']) }}"
>{{ Str::limit($notification->data['title'], 100) }}</a>
<time
  class="text-muted"
  datetime="{{ $notification->created_at->toDateString() }}"
  title="{{ $notification->created_at->toAtomString() }}"
>{{ $notification->created_at->diffForHumans() }}</time>
