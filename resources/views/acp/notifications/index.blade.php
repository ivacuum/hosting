@extends('acp.list')

@section('content-list')
<table class="table-stats table-stats-align-top table-adaptive">
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
        <a href="{{ Acp::show($model) }}">
          {{ str_replace('App\Notifications\\', '', $model->type) }}
        </a>
        <div class="text-xs text-muted">
          {{ $model->notifiable_type }} #{{ $model->notifiable_id }}
        </div>
      </td>
      <td>
        @foreach ($model->data as $index => $data)
          @if (is_string($data) || is_integer($data))
            <div>
              <span class="text-muted">{{ $index }}:</span>
              {{ $data }}
            </div>
          @elseif (is_array($data))
            <div>
              <span class="text-muted">{{ $index }}:</span>
              <span class="text-orange-300">[Array]</span>
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
