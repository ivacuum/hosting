@include('tpl.form_errors')

<div class="form-group">
  <label class="col-md-3 control-label">Статус:</label>
  <div class="col-md-6">
    <div class="radio">
      <label>
        <input type="radio" name="status" value="{{ App\Comment::STATUS_HIDDEN }}" {{ App\Comment::STATUS_HIDDEN == old('status', @$model->status) ? 'checked' : '' }}>
        <span class="text-muted">Скрыт</span>
      </label>
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="status" value="{{ App\Comment::STATUS_PUBLISHED }}" {{ App\Comment::STATUS_PUBLISHED == old('status', @$model->status) ? 'checked' : '' }}>
        <span class="text-success">Опубликован</span>
      </label>
    </div>
  </div>
</div>

<div class="form-group {{ $errors->has('html') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">HTML:</label>
  <div class="col-md-9">
    <textarea required class="form-control textarea-autosized js-autosize-textarea" name="html">{{ old('html', @$model->html) }}</textarea>
  </div>
</div>
