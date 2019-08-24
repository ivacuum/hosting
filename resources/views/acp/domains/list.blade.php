<table class="table-stats table-adaptive">
  <thead>
    <tr>
      <th><input type="checkbox" class="js-select-all" data-selector=".domains-checkbox"></th>
      <th>Домен</th>
      <th>Оплачен до</th>
      <th>Сервер</th>
      <th>NS</th>
      <th>CMS</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td>
        <input class="domains-checkbox" type="checkbox" name="ids[]" value="{{ $model->id }}">
      </td>
      <td>
        <a class="tw-mr-1" href="http://{{ $model->domain }}/" target="_blank">
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
          <span class="tw-bg-gray-600 tw-text-white tw-p-1 tw-text-xs tw-font-bold tw-rounded tooltipped tooltipped-n" aria-label="есть заметки">...</span>
        @endif
        @if (!$model->domain_control)
          <span class="tw-bg-teal-600 tw-text-white tw-p-1 tw-text-xs tw-font-bold tw-rounded tooltipped tooltipped-n" aria-label="не в нашей панели">?</span>
        @endif
        @if ($model->domain_control and $model->isExpired())
          <span class="tw-bg-red-600 tw-text-white tw-p-1 tw-text-xs tw-font-bold tw-rounded tooltipped tooltipped-n" aria-label="просрочена оплата">$</span>
        @endif
        @if ($model->domain_control and $model->isExpiringSoon())
          <span class="tw-bg-orange-400 tw-p-1 tw-text-xs tw-font-bold tw-rounded tooltipped tooltipped-n" aria-label="подходит срок оплаты">$</span>
        @endif
      </td>
      <td class="text-muted">
        <span class="tooltipped tooltipped-n" aria-label="{{ $model->paid_till }}">
          {{ $model->paid_till->toDateString() }}
        </span>
      </td>
      <td>{!! $model->whatServerIpv4() !!}</td>
      <td>{{ $model->firstNsServer() }}</td>
      <td>
        @if (!$model->isExpired() && ($model->cms_url || ($model->alias_id and $model->alias->cms_url)))
          @include('acp.domains.cms_login', ['cms_button_class' => 'btn btn-default btn-sm'])
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

<div class="tw-my-4">
  <form class="form-inline js-batch-form" data-url="/acp/domains/batch" data-selector=".domains-checkbox">
    <div class="tw-mb-4">
      <div class="tw-inline-block tw-mr-1">
        <select required class="custom-select" name="action">
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
    </div>
    <button class="btn btn-default">Выполнить</button>
  </form>
</div>

<div>
  <span class="tw-whitespace-no-wrap tw-mr-2">
    <span class="tw-bg-gray-600 tw-text-white tw-p-1 tw-text-xs tw-font-bold tw-rounded tw-mr-1">...</span>
    есть заметки
  </span>
  <span class="tw-whitespace-no-wrap tw-mr-2">
    <span class="tw-bg-teal-600 tw-text-white tw-py-1 tw-px-2 tw-text-xs tw-font-bold tw-rounded tw-mr-1">?</span>
    не в нашей панели
  </span>
  <span class="tw-whitespace-no-wrap tw-mr-2">
    <span class="tw-bg-red-600 tw-text-white tw-py-1 tw-px-2 tw-text-xs tw-font-bold tw-rounded tw-mr-1">$</span>
    просрочена оплата
  </span>
  <span class="tw-whitespace-no-wrap tw-mr-2">
    <span class="tw-bg-orange-400 tw-py-1 tw-px-2 tw-text-xs tw-font-bold tw-rounded tw-mr-1">$</span>
    подходит срок оплаты
  </span>
</div>
{{--
  <div class="alert alert-warning">
    По заданному критерию не найдено ни одного домена.
  </div>
--}}
