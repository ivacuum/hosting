@extends('dcpp.base')

@section('content')
<div class="antialiased lg:text-lg">
  <h1>{{ trans('dcpp.dc_clients') }}</h1>
  <div class="flex flex-col w-full">
    <a
      class="font-medium py-1"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'airdc') }}"
    >{{ trans('dcpp.airdc') }}</a>
    <a
      class="font-medium py-1"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'apexdc') }}"
    >{{ trans('dcpp.apexdc') }}</a>
    <a
      class="font-medium py-1"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'dcpp') }}"
    >{{ trans('dcpp.dcpp') }}</a>
    <a
      class="font-medium py-1"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'flylinkdc') }}"
    >{{ trans('dcpp.flylinkdc') }}</a>
    <a
      class="font-medium py-1"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'greylinkdc') }}"
    >{{ trans('dcpp.greylinkdc') }}</a>
    <a
      class="font-medium py-1"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'jucydc') }}"
    >{{ trans('dcpp.jucydc') }}</a>
    @ru
      <a
        class="font-medium py-1"
        href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'kalugadc') }}"
      >{{ trans('dcpp.kalugadc') }}</a>
    @endru
    <a
      class="font-medium py-1"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'pelinkdc') }}"
    >{{ trans('dcpp.pelinkdc') }}</a>
    <a
      class="font-medium py-1"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'shakespeer') }}"
    >{{ trans('dcpp.shakespeer') }}</a>
    <a
      class="font-medium py-1"
      href="{{ path([App\Http\Controllers\Dcpp::class, 'page'], 'strongdc') }}"
    >{{ trans('dcpp.strongdc') }}</a>
  </div>
</div>
@endsection
