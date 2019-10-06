@extends('acp.show')

@section('content')
<p>
  <a
    class="btn btn-default"
    href="{{ path([App\Http\Controllers\Acp\Servers\Ftp::class, 'index'], [$model]) }}"
  >FTP</a>
</p>
@if ($model->text)
  <div class="whitespace-pre-line">{{ $model->text }}</div>
@endif
@parent
@endsection
