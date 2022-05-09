<form
  class="flex flex-wrap js-batch-form"
  data-url="{{ $url }}"
  data-selector=".models-checkbox"
>
  <div class="mr-1">
    <select class="form-input" name="action">
      <option value="">Выберите действие...</option>
      @foreach ($actions as $value => $title)
        <option value="{{ $value }}">{{ $title }}</option>
      @endforeach
    </select>
  </div>
  <button class="btn btn-default">Выполнить</button>
</form>
