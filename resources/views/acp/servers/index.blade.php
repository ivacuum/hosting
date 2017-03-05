@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ sizeof($models) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <table class="table-stats table-adaptive">
    <thead>
      <tr>
        <th>#</th>
        <th>Сервер</th>
        <th>Хост</th>
        <th></th>
      </tr>
    </thead>
    @foreach ($models as $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
        <td>{{ $loop->iteration }}</td>
        <td>
          <a href="{{ action("$self@show", $model) }}" class="link">
            {{ $model->title }}
          </a>
        </td>
        <td>{{ $model->host }}</td>
        <td>
          @if ($model->ftp_user and $model->ftp_pass)
            <a class="btn btn-default btn-xs" href="{{ action("$self\Ftp@index", [$model]) }}">
              FTP
            </button>
          @endif
        </td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
