@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="md:text-right">#</th>
    <th>Сервер</th>
    <th>Хост</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td class="md:text-right">{{ ViewHelper::paginatorIteration($models, $loop) }}</td>
      <td>
        <a href="{{ path([$controller, 'show'], $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>{{ $model->host }}</td>
      <td>
        @if ($model->ftp_user and $model->ftp_pass)
          <a
            class="btn btn-default text-sm py-1"
            href="{{ path([App\Http\Controllers\Acp\Servers\Ftp::class, 'index'], [$model]) }}"
          >FTP</a>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
