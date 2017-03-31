@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>#</th>
    <th>Сервер</th>
    <th>Хост</th>
    <th></th>
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
      <td>{{ $model->host }}</td>
      <td>
        @if ($model->ftp_user and $model->ftp_pass)
          <a class="btn btn-default btn-xs" href="{{ action("$self\\Ftp@index", [$model]) }}">FTP</a>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
