{!! Form::text('account')->required()->html() !!}
{!! Form::text('token')->required(!$model->token)->html() !!}

<div class="form-group">
  <label class="col-md-3 control-label">Домены:</label>
  <div class="col-md-9 checkbox">
    @foreach ($domains as $domain)
      <label>
        <input type="checkbox" name="domains[{{ $domain->id }}]" value="1" {{ $model->id && $model->id == $domain->yandex_user_id ? 'checked' : '' }}>
        {{ $domain->domain }}
      </label>
      <br>
    @endforeach
  </div>
</div>
