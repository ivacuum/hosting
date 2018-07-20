@if (!empty($goto))
  <input type="hidden" name="goto" value="{{ $goto }}">
@endif
@csrf
@if (!empty($method))
  {{ method_field(strtoupper($method)) }}
@endif
