{{-- Опубликована новость --}}
{{ trans("notifications.{$class_basename}") }}
<a class="link" href="{{ path('News@show', $notification->data['id']) }}">{{ str_limit($notification->data['title'], 100) }}</a>
