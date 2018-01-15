@extends('acp.base')

@section('content')
<h2>
  <a href="/acp/servers/{{ $server->id }}">
    @svg (chevron-left)
  </a>
  ftp://{{ $server->host }}
</h2>

<h3>
  @if ($dir_up != ':')
    <a href="/acp/servers/{{ $server->id }}/ftp?dir={{ $dir_up }}">
      @svg (chevron-left)
    </a>
  @endif
  {{ $dir }}
</h3>
<table class="table-stats">
  @foreach ($dirs as $row)
    <tr>
      <td>
        @svg (folder-o)
        &nbsp;
        <a href="/acp/servers/{{ $server->id }}/ftp?dir={{ $row['path'] }}">{{ $row['basename'] }}</a>
      </td>
      <td></td>
      <td></td>
    </tr>
  @endforeach
  @foreach ($files as $row)
  <tr>
    <td>
      @svg (file-text-o)
      &nbsp;
      <a href="/acp/servers/{{ $server->id }}/ftp/source?file={{ $row['path'] }}">{{ $row['basename'] }}</a>
    </td>
    <td><span class="text-muted">{{ $row['size'] }} b</span></td>
    <td></td>
  </tr>
  @endforeach
</table>

<div class="mw-500 mt-3">
  <form action="/acp/servers/{{ $server->id }}/ftp/file" method="post">
    {{ ViewHelper::inputHiddenMail() }}
      <div class="input-group">
        <input class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}" name="file" value="{{ old('file') }}">
        <div class="input-group-append">
          <button class="btn btn-default">
            Создать файл
          </button>
        </div>
    </div>

    <input type="hidden" name="path" value="{{ $dir }}">
    {{ csrf_field() }}
  </form>

  <form class="mt-3" action="/acp/servers/{{ $server->id }}/ftp/dir" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    <div class="input-group">
      <input class="form-control {{ $errors->has('dir') ? 'is-invalid' : '' }}" name="dir" value="{{ old('dir') }}">
      <div class="input-group-append">
        <button class="btn btn-default">
          Создать папку
        </button>
      </div>
    </div>

    <input type="hidden" name="path" value="{{ $dir }}">
    {{ csrf_field() }}
  </form>

  <form class="mt-3" action="/acp/servers/{{ $server->id }}/ftp/upload" enctype="multipart/form-data" method="post">
    {{ ViewHelper::inputHiddenMail() }}
    <div class="input-group align-items-center">
      <input class="{{ $errors->has('file') ? 'is-invalid' : '' }}" type="file" name="file">
      <span class="input-group-append">
        <button class="btn btn-default">
          Загрузить файл
        </button>
      </span>
    </div>

    <input type="hidden" name="path" value="{{ $dir }}">
    {{ csrf_field() }}
  </form>
</div>
@endsection
