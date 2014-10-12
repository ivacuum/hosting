@extends('base')

@section('content')
<h2>Активных доменов: {{ sizeof($domains) }} <a class="btn btn-primary" href="{{ route('domains.create') }}">Добавить еще один</a></h2>
<p></p>

<p>
	<span class="label label-info"> &nbsp; </span> &nbsp;— домен не в нашей панели &nbsp;
	<span class="label label-danger"> &nbsp; </span> &nbsp;— просрочена оплата &nbsp;
	<span class="label label-warning"> &nbsp; </span> &nbsp;— подходит срок оплаты домена
</p>

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
    <tr class="js-dblclick-edit {{ $domain->isExpired() ? 'danger' : '' }} {{ !$domain->domain_control ? 'info' : '' }}" data-dblclick-url="{{ route('domains.edit', $domain->domain) }}">
		<td>{{ $key + 1 }}</td>
  		<td>
			<a href="{{ route('domains.show', $domain->domain) }}">{{ $domain->domain }}</a>
		</td>
      <td class="text-muted">
        <span title="{{{ $domain->paid_till }}}">{{{ $domain->paid_till->toDateString() }}}
      </td>
      <td><small><samp>{{ $domain->whatServerIpv4() }}</samp></small></td>
      <td><small>{{ str_limit($domain->ns, 32) }}</small></td>
    </tr>
	@endforeach
</table>
@stop

@section('js')
@parent
<script>
$(function() {
  $('.js-dblclick-edit').bind('dblclick', function() {
    document.location = $(this).data('dblclick-url');
  });
});
</script>
@stop