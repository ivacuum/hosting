@if (!empty($goto))
  <input type="hidden" name="goto" value="{{ $goto }}">
@endif
{{ csrf_field() }}
@if (!empty($method))
  {{ method_field(strtoupper($method)) }}
@endif
