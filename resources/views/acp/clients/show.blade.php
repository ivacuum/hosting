@extends("$tpl.base")

@section('content')
@if ($model->text)
  <blockquote>{!! nl2br($model->text) !!}</blockquote>
@endif

@if (sizeof($model->domains))
  @include('acp.domains.list', [
    'back_url' => Request::fullUrl(),
    'models'   => $model->domains,
    'self'     => 'Acp\Domains',
    'tpl'      => 'acp.domains',
  ])
@else
  <div class="alert alert-warning">У клиента еще нет доменов.</div>
@endif
@endsection
