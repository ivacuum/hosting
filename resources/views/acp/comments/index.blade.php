@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ $models->total() }}</small>
</h3>
@if (sizeof($models))
  <div class="flex-table flex-table-bordered">
    <div class="flex-row flex-row-header">
      <div class="flex-cell text-right">ID</div>
      <div class="flex-cell">Автор</div>
      <div class="flex-cell">Текст</div>
      <div class="flex-cell">Дата</div>
    </div>
    <div class="flex-row-group flex-row-striped">
      @foreach ($models as $model)
        <div class="flex-row js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
          <div class="flex-cell text-right">
            <a class="link" href="{{ action("$self@show", $model) }}">
              {{ $model->id }}
            </a>
          </div>
          <div class="flex-cell">
            @if (!is_null($model->user))
              <a class="link" href="{{ action('Acp\Users@show', $model->user_id) }}">
                {{ $model->user->displayName() }}
              </a>
            @endif
          </div>
          <div class="flex-cell">
            <div>{{ $model->html }}</div>
            <div class="text-muted">
              <small>
                {{ $model->rel_type }} #{{ $model->rel_id }}
              </small>
            </div>
          </div>
          <div class="flex-cell text-nowrap">{{ ViewHelper::dateShort($model->created_at) }}</div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="text-center mt-3">
    @include('tpl.paginator', ['paginator' => $models])
  </div>
@endif
@endsection
