@extends('acp.show')

@section('content')
<p><a class="btn btn-default" href="{{ path("$self\\Ftp@index", [$model]) }}">FTP</a></p>
@if ($model->text)
  <div>{!! nl2br($model->text) !!}</div>
@endif
@parent
@endsection
