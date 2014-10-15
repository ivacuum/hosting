@extends('base')

@section('content')
<div class="boxed-group">
  <h3>
    <a href="{{ route('acp.domains.index') }}"><span class="glyphicon glyphicon-chevron-left"></span></a>
    Добавление домена
  </h3>
  <div class="boxed-group-inner">
    {{ Form::open([
      'route' => 'acp.domains.store',
      'class' => 'form-horizontal'
    ]) }}

    @include('acp.domains.form')

    <div class="form-group">
      <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Добавить домен', ['class' => 'btn btn-primary']) }}
      </div>
    </div>
    {{ Form::close() }}
  </div>
</div>
@stop