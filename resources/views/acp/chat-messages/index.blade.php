<?php /** @var \App\ChatMessage $model */ ?>

@extends('acp.list')

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'status',
  'values' => [
    'Все' => null,
    '---' => null,
    'Скрытые' => App\ChatMessage::STATUS_HIDDEN,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-stats-align-top table-adaptive">
  <thead>
  <tr>
    <th><input type="checkbox" class="form-checkbox js-select-all" data-selector=".models-checkbox"></th>
    <th class="md:text-right">ID</th>
    <th>Автор</th>
    <th>Текст</th>
    <th></th>
    <th>Дата</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td><input class="form-checkbox models-checkbox" type="checkbox" name="ids[]" value="{{ $model->id }}"></td>
      <td class="md:text-right">
        <a href="{{ $model->wwwAcp() }}">
          {{ $model->id }}
        </a>
      </td>
      <td>
        @if ($model->user)
          <a href="{{ $model->wwwAcpUser() }}">
            {{ $model->user->displayName() }}
          </a>
        @endif
      </td>
      <td>{{ $model->text }}</td>
      <td>
        @if ($model->isHidden())
          <span class="tooltipped tooltipped-n" aria-label="Сообщение скрыто">
            @svg (eye-slash)
          </span>
        @endif
      </td>
      <td class="whitespace-no-wrap">{{ ViewHelper::dateShort($model->created_at) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>

<div class="mt-4">
  @include('acp.tpl.batch', ['actions' => [
    'hide' => 'Скрыть',
    'publish' => 'Опубликовать',
    'delete' => 'Удалить',
  ]])
</div>
@endsection
