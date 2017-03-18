@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-right">#</th>
    <th>{{ trans('model.artist.title') }}</th>
    <th>{{ trans('model.artist.slug') }}</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", [$model, 'goto' => Request::fullUrl()]) }}">
      <td class="text-right">{{ $loop->iteration }}</td>
      <td>
        <a class="link" href="{{ action("$self@show", $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>
        <a class="link" href="{{ $locale_uri }}/life/{{ $model->slug }}">
          {{ $model->slug }}
        </a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
