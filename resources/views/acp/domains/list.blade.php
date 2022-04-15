<table class="table-stats table-adaptive">
  <thead>
    <tr>
      <th><input class="border-gray-300 js-select-all" type="checkbox" data-selector=".domains-checkbox"></th>
      <th>Домен</th>
      <th>Оплачен до</th>
      <th>Сервер</th>
      <th>NS</th>
      <th>CMS</th>
    </tr>
  </thead>
  <tbody>
  <?php /** @var \App\Domain $model */ ?>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td>
        <input class="border-gray-300 domains-checkbox" type="checkbox" name="ids[]" value="{{ $model->id }}">
      </td>
      <td>
        <a class="mr-1" href="http://{{ $model->domain }}/" target="_blank">
          @svg (external-link)
        </a>
        <a href="/acp/domains/{{ $model->domain }}">{{ $model->domain }}</a>
        @if ($model->alias_id)
          <span class="text-muted">
            алиас
            <a href="/acp/domains/{{ $model->alias->domain }}">{{ $model->alias->domain }}</a>
          </span>
        @endif
        @if ($model->text)
          <span class="bg-grey-600 text-white p-1 text-xs font-bold rounded tooltipped tooltipped-n" aria-label="есть заметки">...</span>
        @endif
        @if (!$model->domain_control)
          <span class="bg-teal-600 text-white p-1 text-xs font-bold rounded tooltipped tooltipped-n" aria-label="не в нашей панели">?</span>
        @endif
        @if ($model->domain_control and $model->isExpired())
          <span class="bg-red-600 text-white p-1 text-xs font-bold rounded tooltipped tooltipped-n" aria-label="просрочена оплата">$</span>
        @endif
        @if ($model->domain_control and $model->isExpiringSoon())
          <span class="bg-orange-400 p-1 text-xs font-bold rounded tooltipped tooltipped-n" aria-label="подходит срок оплаты">$</span>
        @endif
      </td>
      <td class="text-muted">
        <span class="tooltipped tooltipped-n" aria-label="{{ $model->paid_till }}">
          {{ $model->paid_till?->toDateString() }}
        </span>
      </td>
      <td>{!! $model->whatServerIpv4() !!}</td>
      <td>{{ $model->firstNsServer() }}</td>
      <td>
        @if (!$model->isExpired() && ($model->cms_url || ($model->alias_id && $model->alias->cms_url)))
          @include('acp.domains.cms_login', ['cmsButtonClass' => 'btn btn-default text-sm py-1'])
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

<div class="my-4">
  <form class="flex flex-wrap js-batch-form" data-url="/acp/domains/batch" data-selector=".domains-checkbox">
    <div class="mr-1">
      <select required class="form-input" name="action">
        <option value="">Выберите действие...</option>
        @if ($filter == 'trashed')
          <option value="restore">Восстановить</option>
          <option value="force_delete">Удалить окончательно</option>
        @else
          <option value="activate">Включить мониторинг</option>
          <option value="deactivate">Выключить мониторинг</option>
          <option value="delete">Удалить</option>
        @endif
      </select>
    </div>
    <button class="btn btn-default">Выполнить</button>
  </form>
</div>

<div>
  <span class="whitespace-nowrap mr-2">
    <span class="bg-grey-600 text-white p-1 text-xs font-bold rounded mr-1">...</span>
    есть заметки
  </span>
  <span class="whitespace-nowrap mr-2">
    <span class="bg-teal-600 text-white py-1 px-2 text-xs font-bold rounded mr-1">?</span>
    не в нашей панели
  </span>
  <span class="whitespace-nowrap mr-2">
    <span class="bg-red-600 text-white py-1 px-2 text-xs font-bold rounded mr-1">$</span>
    просрочена оплата
  </span>
  <span class="whitespace-nowrap mr-2">
    <span class="bg-orange-400 py-1 px-2 text-xs font-bold rounded mr-1">$</span>
    подходит срок оплаты
  </span>
</div>
{{--
  <x-alert-warning>
    По заданному критерию не найдено ни одного домена.
  </x-alert-warning>
--}}
