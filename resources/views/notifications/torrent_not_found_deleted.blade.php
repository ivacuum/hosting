{{-- Раздача удалена на сайте-первоисточнике --}}
{{ trans("notifications.{$class_basename}") }}
<a class="link" href="{{ (new App\Torrent(['rto_id' => $notification->data['rto_id']]))->externalLink() }}">{{ Illuminate\Support\Str::limit($notification->data['title'], 100) }}</a>
<time class="text-muted"
      datetime="{{ $notification->created_at->toDateString() }}"
      title="{{ $notification->created_at->toAtomString() }}">
  {{ $notification->created_at->diffForHumans() }}
</time>
<div class="tw-my-2 alert alert-warning">
  {{ trans("notifications.{$class_basename}_help") }}
</div>
<div>
  <a class="btn btn-primary btn-sm" href="{{ (new App\Torrent(['rto_id' => $notification->data['rto_id']]))->externalLink() }}">
    {{ trans('torrents.source') }}
  </a>
</div>
