@if (sizeof($domains))
<div class="boxed-group flush">
  <a href="{{ action('Acp\Domains@create') }}" class="boxed-group-action btn btn-success">
    <span class="glyphicon glyphicon-plus"></span>
  </a>
  <h3>Домены [{{ sizeof($domains) }}]</h3>
  <div class="boxed-group-inner">
    <table class="table-stats">
      <thead>
        <tr>
          <th>#</th>
          <th>Домен</th>
          <th>Оплачен до</th>
          <th>Сервер</th>
          <th>NS</th>
          <th>CMS</th>
        </tr>
      </thead>
      @foreach ($domains as $i => $domain)
        <tr class="js-dblclick-edit {{ $domain->isExpired() ? 'danger' : '' }} {{ !$domain->domain_control ? 'info' : '' }}"
      data-dblclick-url="/acp/domains/{{ $domain->domain }}/edit?goto={{ $back_url }}">
          <td>{{ $i + 1 }}</td>
          <td>
            <a href="http://{{ $domain->domain }}/" target="_blank" style="margin-right: 0.3em;">
              <span class="glyphicon glyphicon-globe"></span>
            </a>
            <a href="/acp/domains/{{ $domain->domain }}">
              {{ $domain->domain }}
            </a>
          </td>
          <td class="text-muted">
            <span title="{{ $domain->paid_till }}">
              {{ $domain->paid_till->toDateString() }}
            </span>
          </td>
          <td><small><samp>{{ $domain->whatServerIpv4() }}</samp></small></td>
          <td><small><samp>{{ $domain->firstNsServer() }}</samp></small></td>
          <td>
            @if ($domain->cms_url)
              @include('acp.domains.cms_login', ['cms_button_class' => 'btn btn-default btn-xs'])
            @endif
          </td>
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
  <div class="alert alert-warning">
    По заданному критерию не найдено ни одного домена.
  </div>
@endif