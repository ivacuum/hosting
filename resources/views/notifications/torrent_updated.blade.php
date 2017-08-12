{{-- Раздача обновлена --}}
{{ trans("notifications.{$class_basename}") }}
<a class="link" href="{{ path('Torrents@show', $notification->data['id']) }}">{{ str_limit($notification->data['title'], 100) }}</a>
<div class="my-1">
  <a class="btn btn-success btn-xs js-magnet"
     href="{{ ViewHelper::magnet($notification->data['info_hash'], $notification->data['announcer'], $notification->data['title']) }}"
     data-action="{{ path('Torrents@magnet', $notification->data['id']) }}">
    {{ trans('torrents.download') }}
  </a>
</div>
