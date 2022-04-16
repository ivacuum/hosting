{{ Form::text('account')->required() }}
{{ Form::text('token')->required(!$model->token) }}

<div class="mb-4">
  <label class="font-bold">Домены</label>
  @foreach ($domains as $domain)
    <label class="flex items-center">
      <input
        class="border-gray-300 mr-2"
        type="checkbox"
        name="domains[{{ $domain->id }}]"
        value="1"
        {{ $model->id && $model->id == $domain->yandex_user_id ? 'checked' : '' }}
      >
      {{ $domain->domain }}
    </label>
  @endforeach
</div>
