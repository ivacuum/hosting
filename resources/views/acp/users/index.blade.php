@extends('acp.list', [
  'search_form' => true,
])

@section('toolbar')
<ul class="nav nav-link-tabs">
  <li class="{{ !$filter ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['filter' => null]) }}">
      Все
    </a>
  </li>
  <li class="{{ $filter === 'weekly-login' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['filter' => 'weekly-login']) }}">
      Заходили на неделе
    </a>
  </li>
  <li class="{{ $filter === 'monthly-login' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['filter' => 'monthly-login']) }}">
      Заходили в месяце
    </a>
  </li>
</ul>
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-right">
      @include('acp.tpl.sortable-header', ['key' => 'id'])
    </th>
    <th>Электронная почта</th>
    <th>Активен</th>
    <th class="text-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'comments_count', 'svg' => 'comment-o'])
    </th>
    <th class="text-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'images_count', 'svg' => 'picture-o'])
    </th>
    <th class="text-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'torrents_count', 'svg' => 'magnet'])
    </th>
    <th>Дата реги</th>
    <th>
      @include('acp.tpl.sortable-header', ['key' => 'last_login_at'])
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td class="text-right">{{ $model->id }}</td>
      <td>
        <a href="{{ path("$self@show", $model) }}">
          {{ $model->email }}
        </a>
      </td>
      <td>
        @if ($model->status === App\User::STATUS_ACTIVE)
          Да
        @endif
      </td>
      <td class="text-right">
        @if ($model->comments_count > 0)
          <a href="{{ path('Acp\Comments@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->comments_count) }}
          </a>
        @endif
      </td>
      <td class="text-right">
        @if ($model->images_count > 0)
          <a href="{{ path('Acp\Images@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->images_count) }}
          </a>
        @endif
      </td>
      <td class="text-right">
        @if ($model->torrents_count > 0)
          <a href="{{ path('Acp\Torrents@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->torrents_count) }}
          </a>
        @endif
      </td>
      <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
      <td>{{ ViewHelper::dateShort($model->last_login_at) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
