@extends('acp.list')

@section('content')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>#</th>
    <th>Название</th>
    <th></th>
    <th>Дата</th>
    <th>URL</th>
    <th class="text-right">@svg (eye)</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
      <td>{{ $loop->iteration }}</td>
      <td>
        <a class="link" href="{{ action("$self@show", $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>
        @if ($model->status === App\Gig::STATUS_HIDDEN)
          @svg (pencil)
        @endif
      </td>
      <td>{{ $model->fullDate() }}</td>
      <td>
        <a class="link" href="{{ $locale_uri }}/life/{{ $model->slug }}">
          {{ $model->slug }}
        </a>
      </td>
      <td class="text-right">
        @if ($model->views > 0)
          {{ ViewHelper::number($model->views) }}
        @endif
      </td>
      <td>
        @if ($model->meta_image)
          @svg (paperclip)
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
