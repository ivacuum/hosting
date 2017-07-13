@extends('acp.list')

@section('toolbar')
<ul class="nav nav-link-tabs">
  <li class="{{ is_null($status) ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['status' => null]) }}">
      Все
    </a>
  </li>
  <li class="{{ $status === (string) App\Torrent::STATUS_HIDDEN ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['status' => App\Torrent::STATUS_HIDDEN]) }}">
      Скрытые
    </a>
  </li>
  <li class="{{ $status == App\Torrent::STATUS_DELETED ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['status' => App\Torrent::STATUS_DELETED]) }}">
      Удаленные
    </a>
  </li>
</ul>
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'id'])
    </th>
    <th>{{ trans('model.author') }}</th>
    <th class="text-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
    <th class="text-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'comments_count', 'svg' => 'comment-o'])
    </th>
    <th class="text-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'clicks', 'svg' => 'magnet'])
    </th>
    <th></th>
    <th>{{ trans('model.torrent.title') }}</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td class="text-right">{{ $model->id }}</td>
      <td>
        <a href="{{ path('Acp\Users@show', $model->user_id) }}">
          {{ $model->user->displayName() }}
        </a>
      </td>
      <td class="text-right">
        @if ($model->views > 0)
          {{ ViewHelper::number($model->views) }}
        @endif
      </td>
      <td class="text-right">
        @if ($model->comments_count > 0)
          {{ ViewHelper::number($model->comments_count) }}
        @endif
      </td>
      <td class="text-right">
        @if ($model->clicks > 0)
          {{ ViewHelper::number($model->clicks) }}
        @endif
      </td>
      <td>
        @if ($model->status === App\Torrent::STATUS_HIDDEN)
          <span class="tooltipped tooltipped-n" aria-label="Раздача скрыта">
            @svg (eye-slash)
          </span>
        @elseif ($model->status === App\Torrent::STATUS_DELETED)
          <span class="tooltipped tooltipped-n" aria-label="Раздача удалена">
            @svg (trash-o)
          </span>
        @endif
      </td>
      <td>
        <a href="{{ path("$self@show", $model) }}">
          <torrent-title title="{{ $model->title }}" hide_brackets="1"></torrent-title>
        </a>
      </td>
      <td>
        <a href="{{ $model->externalLink() }}">
          @svg (external-link)
        </a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
