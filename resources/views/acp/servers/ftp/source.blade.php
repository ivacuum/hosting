@extends('acp.base')

@section('content')
<h2>
  <a href="/acp/servers/{{ $server->id }}">
    @php (require base_path('resources/svg/chevron-left.html'))
  </a>
  ftp://{{ $server->host }}
</h2>

<h2>
  <a href="/acp/servers/{{ $server->id }}/ftp?dir={{ $dir_up }}">
    @php (require base_path('resources/svg/chevron-left.html'))
  </a>
  {{ basename($file) }} <small>{{ $dir_up }}</small>
</h2>

<form action="/acp/servers/{{ $server->id }}/ftp/source" method="post">
  <input type="text" class="input-type-check" name="mail" value="{{ old('mail') }}">

  <div class="form-group">
    <textarea class="form-control textarea-autosized js-autosize-textarea" name="source" rows="2" style="font-family: monospace;">{{ $source }}</textarea>
  </div>

  <button type="submit" class="btn btn-primary">
    Сохранить изменения
  </button>

  <input type="hidden" name="file" value="{{ $file }}">
  {{ csrf_field() }}
</form>
@endsection
