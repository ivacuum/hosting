{{-- Раздача удалена на сайте-первоисточнике --}}
{{ trans("notifications.{$class_basename}") }}
<a class="link" href="{{ (new App\Torrent(['rto_id' => $notification->data['rto_id']]))->externalLink() }}">{{ str_limit($notification->data['title'], 100) }}</a>
<div class="my-1 text-warning">
  {{ trans("notifications.{$class_basename}_help") }}
</div>
<div class="my-1">
  <a class="btn btn-primary btn-xs" href="{{ (new App\Torrent(['rto_id' => $notification->data['rto_id']]))->externalLink() }}">
    {{ trans('torrents.source') }}
  </a>
</div>
