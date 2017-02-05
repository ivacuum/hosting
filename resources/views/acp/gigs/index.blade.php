@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ sizeof($models) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <table class="table-stats">
    <thead>
      <tr>
        <th>#</th>
        <th>Название</th>
        <th></th>
        <th>Дата</th>
        <th>URL</th>
        <th></th>
      </tr>
    </thead>
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
        <td>
          @if ($model->meta_image)
            @svg (paperclip)
          @endif
        </td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
