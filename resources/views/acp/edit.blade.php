@extends("$tpl.base")

<?php Form::model($model); ?>

@section('content')
<form action="{{ action("$self@update", $model) }}" class="form-horizontal" method="post">

  @include("$tpl.form")

  <div class="form-group">
    <div class="col-md-9 col-md-offset-3">
      <button type="submit" class="btn btn-primary">
        {{ trans('acp.save') }}
      </button>
      <button type="submit" name="_save" class="btn btn-default">
        {{ trans('acp.apply') }}
      </button>
    </div>
  </div>

  @include('acp.tpl.hidden_fields', ['method' => 'put'])
</form>
@endsection
