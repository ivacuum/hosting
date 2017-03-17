@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>Уведомление</th>
    <th>Данные</th>
    <th>Отправлено</th>
    <th>Прочитано</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr>
      <td>
        <a class="link" href="{{ action("$self@show", $model->id) }}">
          {{ str_replace('App\Notifications\\', '', $model->type) }}
        </a>
        <div class="text-muted small">
          {{ $model->notifiable_type }} #{{ $model->notifiable_id }}
        </div>
      </td>
      <td>
        @foreach (json_decode($model->data, true) as $index => $data)
          @if (is_string($data) || is_integer($data))
            <div>
              <span class="text-muted">{{ $index }}:</span>
              {{ $data }}
            </div>
          @elseif (is_array($data))
            <div>
              <span class="text-muted">{{ $index }}:</span>
              <span class="text-warning">[Array]</span>
            </div>
          @endif
        @endforeach
      </td>
      <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
      <td>{{ $model->read_at ? ViewHelper::dateShort($model->read_at) : '' }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
