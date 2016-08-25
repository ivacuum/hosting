@extends("$tpl.base")

@section('content')
@if (sizeof($model->domains))
  @include('acp.domains.list', [
    'back_url' => Request::fullUrl(),
    'models'   => $model->domains,
    'self'     => 'Acp\Domains',
    'tpl'      => 'acp.domains',
])
@else
  <div class="alert alert-warning">На этот аккаунт еще не добавлены домены.</div>
@endif
@endsection
