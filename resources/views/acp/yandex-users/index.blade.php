@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="md:text-right">#</th>
    <x-th-sortable key="account"/>
    <x-th-numeric-sortable key="domains_count"/>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ Acp::edit($model) }}">
      <td class="md:text-right">{{ ViewHelper::paginatorIteration($models, $loop) }}</td>
      <td>
        <a href="{{ Acp::show($model) }}">
          {{ $model->account }}
        </a>
      </td>
      <td class="md:text-right">{{ $model->domains_count }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
