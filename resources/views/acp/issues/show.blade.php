<?php /** @var App\Issue $model */ ?>

@extends('acp.show')
@include('livewire')

@section('content')
<div>
  @if ($model->status->isClosed())
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
  @livewire(App\Http\Livewire\Comments::class, ['model' => $model])

  @if($model->canBeCommented())
    @livewire(App\Http\Livewire\CommentAddForm::class, ['model' => $model])
  @endif
</div>

@parent
@endsection
