@extends('acp.base')

@section('content')
<h3>
  Концерты
  <small>{{ sizeof($gigs) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($gigs))
  <table class="table-stats m-b-1">
    <colgroup>
      <col width="35">
      <col width="*">
      <col width="35">
      <col width="200">
      <col width="200">
    </colgroup>
    <thead>
      <tr>
        <th>#</th>
        <th>Название</th>
        <th></th>
        <th>Дата</th>
        <th>URL</th>
      </tr>
    </thead>
    @foreach ($gigs as $i => $gig)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $gig) }}">
        <td>{{ $i + 1 }}</td>
        <td>
          <a class="link" href="{{ action("$self@show", $gig) }}">
            {{ $gig->title }}
          </a>
        </td>
        <td>
          @if ($gig->status === App\Gig::STATUS_HIDDEN)
            @php (require base_path('resources/svg/pencil.html'))
          @endif
        </td>
        <td>{{ $gig->fullDate() }}</td>
        <td>
          <a class="link" href="{{ action('Life@page', $gig->slug) }}">
            {{ $gig->slug }}
          </a>
        </td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
