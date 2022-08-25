@extends('base')

@push('head')
<meta name="robots" content="noindex">
@endpush

@section('content')
<div class="font-medium text-3xl tracking-tight mb-2">Загрузить файлы</div>
<form method="post" action="/up" enctype="multipart/form-data">
  {{ ViewHelper::inputHiddenMail() }}
  @csrf

  <input
    class="block w-full"
    type="file"
    name="files[]"
    multiple
  >

  <div class="mt-4">
    <button class="btn btn-default">Отправить</button>
  </div>
</form>
@endsection
