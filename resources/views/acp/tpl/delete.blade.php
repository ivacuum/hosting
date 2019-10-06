@can('destroy', $model)
  <a class="border-l-2 border-transparent px-3 py-2 js-entity-action"
     data-confirm="{{ trans('acp.delete_confirm') }}"
     data-method="delete"
     href="{{ path([$controller, 'destroy'], $model) }}">
    {{ trans('acp.delete') }}
  </a>
@endcan
