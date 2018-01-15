{!! Form::text('account')->required()->html() !!}
{!! Form::text('token')->required(!$model->token)->html() !!}

<div class="form-group form-row">
  <label class="col-md-4 text-md-right">Домены</label>
  <div class="col-md-8">
    @foreach ($domains as $domain)
      <label class="form-check">
        <input class="form-check-input" type="checkbox" name="domains[{{ $domain->id }}]" value="1" {{ $model->id && $model->id == $domain->yandex_user_id ? 'checked' : '' }}>
        <span class="form-check-label">{{ $domain->domain }}</span>
      </label>
    @endforeach
  </div>
</div>
