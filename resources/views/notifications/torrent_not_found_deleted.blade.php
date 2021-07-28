{{-- Раздача удалена на сайте-первоисточнике --}}
@lang("ui.notifications.{$basename}")
<a class="link" href="{{ (new App\Torrent(['rto_id' => $notification->data['rto_id']]))->externalLink() }}">{{ Str::limit($notification->data['title'], 101) }}</a>
<time
  class="text-muted"
  datetime="{{ $notification->created_at->toDateString() }}"
  title="{{ $notification->created_at->toAtomString() }}"
>{{ $notification->created_at->diffForHumans() }}</time>
<div class="my-2 py-3 px-5 text-yellow-800/75 bg-yellow-300/25 border border-yellow-200 rounded">
  @lang("ui.notifications.{$basename}_help")
</div>
<div>
  <a class="btn btn-primary text-sm py-1" href="{{ (new App\Torrent(['rto_id' => $notification->data['rto_id']]))->externalLink() }}">
    @lang('Первоисточник')
  </a>
</div>
