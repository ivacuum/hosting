@include('tpl.form_errors')

<div class="form-group {{ $errors->has('html') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">HTML:</label>
  <div class="col-md-9">
    <textarea required class="form-control textarea-autosized js-autosize-textarea" name="html">{{ old('html', @$model->html) }}</textarea>
  </div>
</div>
