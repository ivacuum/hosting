@extends('dcpp.base')

@section('content')
<div class="antialiased lg:text-lg">
  <h1>{{ trans('dcpp.dc_clients') }}</h1>
  <div class="flex flex-col w-full">
    <a class="font-medium py-1" href="{{ path('Dcpp@page', 'airdc') }}">{{ trans('dcpp.airdc') }}</a>
    <a class="font-medium py-1" href="{{ path('Dcpp@page', 'apexdc') }}">{{ trans('dcpp.apexdc') }}</a>
    <a class="font-medium py-1" href="{{ path('Dcpp@page', 'dcpp') }}">{{ trans('dcpp.dcpp') }}</a>
    <a class="font-medium py-1" href="{{ path('Dcpp@page', 'flylinkdc') }}">{{ trans('dcpp.flylinkdc') }}</a>
    <a class="font-medium py-1" href="{{ path('Dcpp@page', 'greylinkdc') }}">{{ trans('dcpp.greylinkdc') }}</a>
    <a class="font-medium py-1" href="{{ path('Dcpp@page', 'jucydc') }}">{{ trans('dcpp.jucydc') }}</a>
    @ru
      <a class="font-medium py-1" href="{{ path('Dcpp@page', 'kalugadc') }}">{{ trans('dcpp.kalugadc') }}</a>
    @endru
    <a class="font-medium py-1" href="{{ path('Dcpp@page', 'pelinkdc') }}">{{ trans('dcpp.pelinkdc') }}</a>
    <a class="font-medium py-1" href="{{ path('Dcpp@page', 'shakespeer') }}">{{ trans('dcpp.shakespeer') }}</a>
    <a class="font-medium py-1" href="{{ path('Dcpp@page', 'strongdc') }}">{{ trans('dcpp.strongdc') }}</a>
  </div>
</div>
@endsection
