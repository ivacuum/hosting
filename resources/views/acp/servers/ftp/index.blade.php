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



<form action="/acp/servers/{{ $server->id }}/ftp/file" method="post">
  {{ ViewHelper::inputHiddenMail() }}
  <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
    <div class="input-group" style="width: 30em;">
      <input type="text" class="form-control" name="file" value="{{ old('file') }}">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          Создать файл
        </button>
      </span>
    </div>
  </div>

  <input type="hidden" name="path" value="{{ $dir }}">
  {{ csrf_field() }}
</form>

<form action="/acp/servers/{{ $server->id }}/ftp/dir" method="post">
  {{ ViewHelper::inputHiddenMail() }}
  <div class="form-group {{ $errors->has('dir') ? 'has-error' : '' }}">
    <div class="input-group" style="width: 30em;">
      <input type="text" class="form-control" name="dir" value="{{ old('dir') }}">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          Создать папку
        </button>
      </span>
    </div>
  </div>

  <input type="hidden" name="path" value="{{ $dir }}">
  {{ csrf_field() }}
</form>

<form action="/acp/servers/{{ $server->id }}/ftp/upload" enctype="multipart/form-data" method="post">
  {{ ViewHelper::inputHiddenMail() }}
  <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
    <div class="input-group" style="width: 30em;">
      <input type="file" class="form-control" name="file">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          Загрузить файл
        </button>
      </span>
    </div>
  </div>

  <input type="hidden" name="path" value="{{ $dir }}">
  {{ csrf_field() }}
</form>
@endsection
