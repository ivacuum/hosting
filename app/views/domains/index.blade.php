@extends('base')

@section('content')
<p>Активных доменов: {{ sizeof($domains) }}</p>

<table class="table table-condensed table-striped">
	@foreach($domains as $key => $domain)
    <tr>
		<td>{{ $key + 1 }}</td>
  		<td><a href="{{ URL::route('domains.show', $domain->id) }}">{{ $domain->domain }}</td>
      <td class="text-muted">
        {{ $domain->paid_till }}
      </td>
      <td>{{ $domain->ipv4 }}</td>
      <td><small>{{ str_limit($domain->ns, 32) }}</small></td>
    </tr>
	@endforeach
</table>
@stop