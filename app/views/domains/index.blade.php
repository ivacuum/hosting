@extends('base')

@section('content')
<p>Активных доменов: {{ sizeof($domains) }}</p>

<table class="table table-condensed table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Домен</th>
			<th>Оплачен до</th>
			<th>Сервер</th>
			<th>NS</th>
		</tr>
	</thead>
	@foreach($domains as $key => $domain)
    <tr class="{{ $domain->isExpired() ? 'danger' : '' }} {{ !$domain->domain_control ? 'info' : '' }}">
		<td>{{ $key + 1 }}</td>
  		<td>
			<a href="{{ URL::route('domains.show', $domain->id) }}">{{ $domain->domain }}</a>
		</td>
      <td class="text-muted">
        {{ $domain->paid_till }}
      </td>
      <td><small><samp>{{ $domain->whatServerIpv4() }}</samp></small></td>
      <td><small>{{ str_limit($domain->ns, 32) }}</small></td>
    </tr>
	@endforeach
</table>
@stop