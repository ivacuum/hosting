@extends('base')

@push('head')
<meta name="robots" content="noindex">
@endpush

@section('content')
<div class="h2">Загрузить файлы</div>
<form method="post" action="/up" enctype="multipart/form-data">
  {{ ViewHelper::inputHiddenMail() }}
  @csrf

  <input
    class="block w-full"
    accept="image/gif,image/jpeg,image/png"
    type="file"
    name="files[]"
    multiple
  >

  <div class="mt-4">
    <button class="btn btn-default">Отправить</button>
  </div>
</form>
@endsection
