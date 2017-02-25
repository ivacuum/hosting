@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ $models->total() }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <div class="flex-table flex-table-bordered">
    <div class="flex-row flex-row-header">
      <div class="flex-cell text-right">ID</div>
      <div class="flex-cell">Электронная почта</div>
      <div class="flex-cell">Активен</div>
    </div>
    <div class="flex-row-group flex-row-striped">
      @foreach ($models as $model)
        <div class="flex-row js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
          <div class="flex-cell text-right">{{ $model->id }}</div>
          <div class="flex-cell">
            <a href="{{ action("$self@show", $model) }}" class="link">
              {{ $model->email }}
            </a>
          </div>
          <div class="flex-cell">
            @if ($model->status === App\User::STATUS_ACTIVE)
              Да
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>

  @include('tpl.paginator', ['class' => 'mt-3 text-center', 'paginator' => $models])
@endif
@endsection
