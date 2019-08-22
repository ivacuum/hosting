@extends('acp.show')

@section('content')
<p><a class="btn btn-default" href="{{ path("$self\\Ftp@index", [$model]) }}">FTP</a></p>
@if ($model->text)
  <div class="tw-whitespace-pre-line">{{ $model->text }}</div>
@endif
@parent
@endsection
