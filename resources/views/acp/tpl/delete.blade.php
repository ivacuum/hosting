<form action="{{ action("$self@destroy", $id) }}" method="post">
  <div class="form-group">
    <button class="btn btn-default js-confirm" data-confirm="Запись будет удалена. Продолжить?" type="submit">
      @include('tpl.svg.trash-o')
    </button>
  </div>

  {{ csrf_field() }}
  {{ method_field('DELETE') }}
</form>
