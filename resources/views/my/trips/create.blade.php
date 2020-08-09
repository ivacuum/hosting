@extends('my.base')

@section('content')
<h3>@lang('acp.trips.create')</h3>

<form action="@lng/my/trips" method="post">

  @include('my.trips.form')

  <button class="btn btn-primary">@lang('acp.trips.add')</button>

</form>
@endsection
