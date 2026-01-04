<form
  class="flex flex-wrap js-batch-form"
  data-url="{{ $url }}"
  data-selector=".models-checkbox"
>
  <div class="mr-1">
    <select class="the-input" name="action">
      <option value="">@lang('Выберите действие...')</option>
      @foreach ($actions as $value => $title)
        <option value="{{ $value }}">{{ $title }}</option>
      @endforeach
    </select>
  </div>
  <button class="btn btn-default">@lang('Выполнить')</button>
</form>
