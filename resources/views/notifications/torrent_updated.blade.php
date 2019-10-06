{{-- Раздача обновлена --}}
{{ trans("notifications.{$classBasename}") }}
<a class="link" href="{{ path([App\Http\Controllers\Torrents::class, 'show'], $notification->data['id']) }}">{{ Str::limit($notification->data['title'], 100) }}</a>
<time
  class="text-muted"
  datetime="{{ $notification->created_at->toDateString() }}"
  title="{{ $notification->created_at->toAtomString() }}"
>{{ $notification->created_at->diffForHumans() }}</time>
<div class="mt-2">
  <a
    class="btn btn-success text-sm py-1 js-magnet"
    href="{{ ViewHelper::magnet($notification->data['info_hash'], $notification->data['announcer'], $notification->data['title']) }}"
    data-action="{{ path([App\Http\Controllers\Torrents::class, 'magnet'], $notification->data['id']) }}"
  >
    {{ trans('torrents.download') }}
  </a>
</div>
