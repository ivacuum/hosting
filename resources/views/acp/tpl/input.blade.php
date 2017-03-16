<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
  <label class="col-md-3 control-label {{ $required ? 'required' : '' }}">
    {{ trans("model.{$entity}.{$name}") }}:
  </label>
  <div class="col-md-6">
    <input {{ $required ? 'required' : '' }} type="{{ $type }}" class="form-control" name="{{ $name }}" value="{{ old($name, $model->{$name}) }}">
    @if ($errors->has($name))
      <span class="help-block">{{ $errors->first($name) }}</span>
    @endif
  </div>
</div>
