{{-- Раздача удалена на сайте-первоисточнике --}}
{{ trans("notifications.{$classBasename}") }}
<a class="link" href="{{ (new App\Torrent(['rto_id' => $notification->data['rto_id']]))->externalLink() }}">{{ Str::limit($notification->data['title'], 100) }}</a>
<time class="text-muted"
      datetime="{{ $notification->created_at->toDateString() }}"
      title="{{ $notification->created_at->toAtomString() }}">
  {{ $notification->created_at->diffForHumans() }}
</time>
<div class="my-2 alert alert-warning">
  {{ trans("notifications.{$classBasename}_help") }}
</div>
<div>
  <a class="btn btn-primary text-sm py-1" href="{{ (new App\Torrent(['rto_id' => $notification->data['rto_id']]))->externalLink() }}">
    {{ trans('torrents.source') }}
  </a>
</div>
