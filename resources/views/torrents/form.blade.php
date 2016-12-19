@include('tpl.form_errors')

<div class="form-group {{ $errors->has('input') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Ссылка или инфо-хэш:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="input" value="{{ old('input') }}">
    <p class="help-block">Ссылка вида <span class="text-success">http://rutracker.org/forum/viewtopic.php?t=4031882</span><br>или инфо-хэш вида <span class="text-success">9B5D85FFC234737E7D7C246FECB6BB1EC5E8F0B9</span></p>
  </div>
</div>
