@extends("life.trips.{$template}")

@section('content_header')
<div class="lead js-shortcuts-items">
  <div class="trip-text js-trip-shortcuts trip-lang-{{ $locale }}">
@endsection

@section('content_footer')
  </div>
</div>
@endsection
