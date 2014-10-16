@if (sizeof($domains))
<div class="boxed-group flush">
	<a href="{{ route('acp.domains.create') }}" class="boxed-group-action btn btn-success">
		<span class="glyphicon glyphicon-plus"></span>
	</a>
	<h3>Домены</h3>
	<div class="boxed-group-inner">
		<table class="table-stats">
			<thead>
				<tr>
					<th>#</th>
					<th>Домен</th>
					<th>Оплачен до</th>
					<th>Сервер</th>
					<th>NS</th>
				</tr>
			</thead>
			@foreach ($domains as $key => $domain)
		    <tr class="js-dblclick-edit {{ $domain->isExpired() ? 'danger' : '' }} {{ !$domain->domain_control ? 'info' : '' }}" data-dblclick-url="{{ route('acp.domains.edit', $domain->domain) }}">
				<td>{{ $key + 1 }}</td>
		  		<td>
					<a href="{{ route('acp.domains.show', $domain->domain) }}">
						{{ $domain->domain }}
					</a>
				</td>
		      <td class="text-muted">
		        <span title="{{{ $domain->paid_till }}}">
					{{{ $domain->paid_till->toDateString() }}}
				</span>
		      </td>
		      <td><small><samp>{{ $domain->whatServerIpv4() }}</samp></small></td>
		      <td><small>{{ str_limit($domain->ns, 32) }}</small></td>
		    </tr>
			@endforeach
		</table>
	</div>
</div>

<p>
	<span class="label label-info"> &nbsp; </span> &nbsp;— не в нашей панели &nbsp;
	<span class="label label-danger"> &nbsp; </span> &nbsp;— просрочена оплата &nbsp;
	<span class="label label-warning"> &nbsp; </span> &nbsp;— подходит срок оплаты
</p>
@else
<div class="alert alert-warning">По заданному критерию не найдено ни одного домена.</div>
@endif