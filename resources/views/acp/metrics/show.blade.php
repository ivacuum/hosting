@extends('acp.base')

@section('content')
<h2 class="font-medium text-3xl mb-2 break-words">
  {{ $event }}
  <span class="text-base text-gray-500 whitespace-nowrap">{{ ViewHelper::number(array_sum($yearly)) }}</span>
</h2>

<table class="table-stats mb-8">
  <thead>
    <tr>
      <th>Год</th>
      <th class="text-right">Кол-во</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($yearly as $year => $total)
      <tr>
        <td>{{ $year }}</td>
        <td class="text-right whitespace-nowrap">{{ ViewHelper::number($total) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

@foreach ($daily as $year => $months)
  <h3 class="font-medium text-xl mb-2">{{ $year }}</h3>
  <div class="overflow-x-auto mb-6">
    <table class="table-stats text-sm">
      <thead>
        <tr>
          <th></th>
          @for ($d = 1; $d <= 31; $d++)
            <th class="text-right px-1 text-xs text-gray-500">{{ $d }}</th>
          @endfor
        </tr>
      </thead>
      <tbody>
        @for ($m = 1; $m <= 12; $m++)
          @php $daysInMonth = \Carbon\Carbon::create($year, $m)->daysInMonth @endphp
          <tr>
            <td class="text-gray-500 whitespace-nowrap">{{ \Carbon\Carbon::create($year, $m)->isoFormat('MMM') }}</td>
            @for ($d = 1; $d <= 31; $d++)
              @if ($d > $daysInMonth)
                <td></td>
              @else
                @php $value = $months[$m][$d] ?? null @endphp
                @if ($value === null || $value === 0)
                  <td></td>
                @else
                  <td class="text-right px-1">{{ $value }}</td>
                @endif
              @endif
            @endfor
          </tr>
        @endfor
      </tbody>
    </table>
  </div>
@endforeach
@endsection
