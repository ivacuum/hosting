@extends('acp.base')

@section('content')
<h2>
  <a href="/acp/servers/{{ $server->id }}">
    @svg (chevron-left)
  </a>
  ftp://{{ $server->host }}
</h2>

<h2>
  <a href="/acp/servers/{{ $server->id }}/ftp?dir={{ $dir_up }}">
    @svg (chevron-left)
  </a>
  {{ basename($file) }}
  <small class="text-muted">{{ $dir_up }}</small>
</h2>

<form action="/acp/servers/{{ $server->id }}/ftp/source" method="post">
  {{ ViewHelper::inputHiddenMail() }}
  @csrf

  <div class="form-group">
    <textarea class="form-control f14 textarea-autosized js-autosize-textarea" name="source" rows="2" style="font-family: var(--font-family-monospace);">{{ $source }}</textarea>
  </div>

  <button class="btn btn-primary">
    Сохранить изменения
  </button>

  <input type="hidden" name="file" value="{{ $file }}">
</form>
@endsection
