@can('delete', $model)
  <a class="border-l-2 border-transparent px-3 py-2 js-entity-action"
     data-confirm="@lang('acp.delete_confirm')"
     data-method="delete"
     href="{{ Acp::destroy($model) }}">
    @lang('acp.delete')
  </a>
@endcan
