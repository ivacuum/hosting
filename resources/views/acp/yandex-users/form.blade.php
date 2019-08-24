{!! Form::text('account')->required()->html() !!}
{!! Form::text('token')->required(!$model->token)->html() !!}

<div class="tw-mb-4">
  <label>Домены</label>
  @foreach ($domains as $domain)
    <label class="tw-flex tw-items-center tw-font-normal">
      <input class="tw-mr-2" type="checkbox" name="domains[{{ $domain->id }}]" value="1" {{ $model->id && $model->id == $domain->yandex_user_id ? 'checked' : '' }}>
      {{ $domain->domain }}
    </label>
  @endforeach
</div>
