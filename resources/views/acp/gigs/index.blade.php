<?php
/** @var \App\Gig $model */
?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="md:text-right">#</th>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'title') }}</th>
    <th></th>
    <th>
      @include('acp.tpl.sortable-header', ['key' => 'date'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'slug') }}</th>
    <th class="md:text-right whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
    <th>@svg (paperclip)</th>
    <th class="md:text-right"></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td class="md:text-right">{{ ViewHelper::paginatorIteration($models, $loop) }}</td>
      <td><a href="{{ $model->wwwAcp() }}">{{ $model->title }}</a></td>
      <td>
        @if ($model->isHidden())
          <span class="tooltipped tooltipped-n" aria-label="Заметка пишется">
            @svg (pencil)
          </span>
        @endif
      </td>
      <td>{{ $model->fullDate() }}</td>
      <td><a href="{{ $model->www() }}">{{ $model->slug }}</a></td>
      <td class="md:text-right whitespace-no-wrap">
        {{ ViewHelper::number($model->views) ?: '' }}
      </td>
      <td>
        @if ($model->meta_image)
          <a href="{{ $model->meta_image }}">
            <span class="tooltipped tooltipped-n" aria-label="Обложка">
              @svg (paperclip)
            </span>
          </a>
        @endif
      </td>
      <td class="md:text-right">
        <a href="{{ path([App\Http\Controllers\Acp\Dev\GigTemplates::class, 'show'], str_replace('.', '_', $model->slug)) }}">
          @svg (file-text-o)
        </a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
