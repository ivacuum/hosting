@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>#</th>
    <th>Название</th>
    <th></th>
    <th>Дата</th>
    <th>URL</th>
    <th class="text-right">@svg (eye)</th>
    <th class="text-right">@svg (comment-o)</th>
    <th></th>
    <th class="text-right">@svg (picture-o)</th>
    <th class="text-right"></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td>{{ $loop->iteration }}</td>
      <td>
        <a class="link" href="{{ action("$self@show", $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>
        @if ($model->status === App\Trip::STATUS_HIDDEN)
          <span class="tooltipped tooltipped-n" aria-label="Заметка скрыта">
            @svg (eye-slash)
          </span>
        @elseif ($model->status === App\Trip::STATUS_INACTIVE)
          <span class="tooltipped tooltipped-n" aria-label="Заметка неактивна">
            @svg (pencil)
          </span>
        @endif
      </td>
      <td>{{ $model->localizedDate() }}</td>
      <td>
        <a class="link" href="{{ $locale_uri }}/life/{{ $model->slug }}">
          {{ $model->slug }}
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
      <td>
        @if ($model->meta_image)
          <span class="tooltipped tooltipped-n" aria-label="Задано фото">
            @svg (paperclip)
          </span>
        @endif
      </td>
      <td class="text-right">
        @if ($model->photos_count > 0)
          <a class="link" href="{{ action('Acp\Photos@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->photos_count) }}
          </a>
        @endif
      </td>
      <td class="text-right">
        <a href="{{ action('Acp\Dev\Templates@template', str_replace('.', '_', $model->slug)) }}">
          @svg (file-text-o)
        </a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
