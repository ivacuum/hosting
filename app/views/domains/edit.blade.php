@extends('base')

@section('content')
<div class="boxed-group">
  <h3>
    <a href="{{ route('domains.index') }}"><span class="glyphicon glyphicon-chevron-left"></span></a>
    Редактирование домена <small>{{ $domain->domain }}</small>
  </h3>
  <div class="boxed-group-inner">
    {{ Form::model($domain, [
      'route' => ['domains.update', $domain->domain],
      'method' => 'put',
      'class' => 'form-horizontal'
    ]) }}

    @include('domains.form')

    <div class="form-group">
      <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Обновить информацию', ['class' => 'btn btn-primary']) }}
      </div>
    </div>
    {{ Form::close() }}
  </div>
</div>
@stop
