{{-- Опубликована новость --}}
{{ trans("notifications.{$class_basename}") }}
<a class="link" href="{{ path('News@show', $notification->data['id']) }}">{{ Illuminate\Support\Str::limit($notification->data['title'], 100) }}</a>
<time class="text-muted"
      datetime="{{ $notification->created_at->toDateString() }}"
      title="{{ $notification->created_at->toAtomString() }}">
  {{ $notification->created_at->diffForHumans() }}
</time>
