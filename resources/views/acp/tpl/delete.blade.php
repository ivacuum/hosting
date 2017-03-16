@can('destroy', $model)
  <a class="list-group-item js-entity-action"
     data-confirm="{{ trans('acp.delete_confirm') }}"
     data-method="delete"
     href="{{ action("$self@destroy", $model) }}">
    {{ trans('acp.delete') }}
  </a>
@endcan
