<?php
/** @var App\Issue $model */
?>

@extends('acp.show')

@section('content')
<div>
  @if ($model->isClosed())
    <span class="text-green-600">
      @svg (check)
    </span>
    Закрыто
    <form class="inline" action="{{ path(App\Http\Controllers\Acp\IssueOpenController::class, $model) }}" method="post">
      @csrf
      <button class="btn btn-default text-sm leading-none">
        Открыть
      </button>
    </form>
  @else
    <span class="text-red-600">
      @svg (issue-opened)
    </span>
    Открыто
    <form class="inline" action="{{ path(App\Http\Controllers\Acp\IssueCloseController::class, $model) }}" method="post">
      @csrf
      <button class="btn btn-default text-sm leading-none">
        Закрыть
      </button>
    </form>
  @endif
</div>
<div class="flex">
  <div class="bg-light border mt-2 p-2 rounded">
    <div class="text-muted">{{ $model->email }}</div>
    <div><a href="{{ $model->page }}">{{ $model->page }}</a></div>
  </div>
</div>

<div class="my-4 whitespace-pre-line">{{ $model->text }}</div>

<div>
  @include('tpl.comments-list', ['comments' => $model->comments])
</div>

@if ($model->isNotClosed())
  <form action="{{ path(App\Http\Controllers\Acp\IssueCommentController::class, $model) }}" method="post">
    @csrf

    <div class="my-2">
      <textarea
        required
        class="form-textarea"
        rows="4"
        placeholder="Текст ответа..."
        name="text"
      ></textarea>
    </div>
    <button class="btn btn-primary">Отправить</button>
  </form>
@endif

@parent
@endsection
