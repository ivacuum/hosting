@extends('acp.base')

@section('content')
<h3>
  {{ trans("$tpl.index") }}
  <small>{{ sizeof($models) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <table class="table-stats m-b-1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Автор</th>
        <th>Название</th>
      </tr>
    </thead>
    @foreach ($models as $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
        <td>{{ $model->id }}</td>
        <td>
          <a class="link" href="{{ action('Acp\Users@show', $model->user_id) }}">
            {{ $model->user->login ?? $model->user->email }}
          </a>
        </td>
        <td>
          <a class="link" href="{{ action("$self@show", $model) }}">{{ $model->title }}</a>
          <a href="https://rutracker.org/forum/viewtopic.php?t={{ $model->rto_id }}">
            @svg (external-link)
          </a>
        </td>
      </tr>
    @endforeach
  </table>

  <div class="pull-right clearfix">
    @include('tpl.paginator', ['paginator' => $models])
  </div>
@endif
@endsection
