@extends('acp.dev.base')

@section('content')
<h2 class="m-t-0">Создание миниатюр</h2>
<form action="{{ action("$self@thumbnailsPost") }}" class="form-horizontal" method="post" enctype="multipart/form-data">

  @include('tpl.form_errors')

  <div class="form-group {{ $errors->has('count') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label required">Файлы:</label>
    <div class="col-md-6">
      <input required type="file" name="files[]" multiple min="1" max="100">
    </div>
  </div>

  @include('acp.tpl.hidden_fields')

  <div class="form-group">
    <div class="col-md-6 col-md-offset-3">
      <button type="submit" class="btn btn-primary">
        Создать
      </button>
    </div>
  </div>
</form>
@endsection
