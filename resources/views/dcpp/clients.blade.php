@extends('dcpp.base')

@section('content')
<div class="antialiased lg:text-lg">
  <h1 class="font-medium text-4xl tracking-tight mb-2">@lang('Клиенты DC++')</h1>
  <div class="flex flex-col w-full">
    <a class="font-medium py-1" href="@lng/dc/airdc">@lang('dcpp.airdc')</a>
    <a class="font-medium py-1" href="@lng/dc/apexdc">@lang('dcpp.apexdc')</a>
    <a class="font-medium py-1" href="@lng/dc/dcpp">@lang('dcpp.dcpp')</a>
    <a class="font-medium py-1" href="@lng/dc/flylinkdc">@lang('dcpp.flylinkdc')</a>
    <a class="font-medium py-1" href="@lng/dc/greylinkdc">@lang('dcpp.greylinkdc')</a>
    <a class="font-medium py-1" href="@lng/dc/jucydc">@lang('dcpp.jucydc')</a>
    @ru
      <a class="font-medium py-1" href="@lng/dc/kalugadc">@lang('dcpp.kalugadc')</a>
    @endru
    <a class="font-medium py-1" href="@lng/dc/pelinkdc">@lang('dcpp.pelinkdc')</a>
    <a class="font-medium py-1" href="@lng/dc/shakespeer">@lang('dcpp.shakespeer')</a>
    <a class="font-medium py-1" href="@lng/dc/strongdc">@lang('dcpp.strongdc')</a>
  </div>
</div>
@endsection
