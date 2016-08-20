@extends('life.base')

@section('content_header')
@parent
<div class="trip-text js-trip-shortcuts trip-lang-{{ $locale }}">
@endsection

@section('content_footer')
</div>
@parent
@endsection
