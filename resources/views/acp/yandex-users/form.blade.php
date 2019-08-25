{!! Form::text('account')->required()->html() !!}
{!! Form::text('token')->required(!$model->token)->html() !!}

<div class="mb-4">
  <label>Домены</label>
  @foreach ($domains as $domain)
    <label class="flex items-center font-normal">
      <input class="mr-2" type="checkbox" name="domains[{{ $domain->id }}]" value="1" {{ $model->id && $model->id == $domain->yandex_user_id ? 'checked' : '' }}>
      {{ $domain->domain }}
    </label>
  @endforeach
</div>
