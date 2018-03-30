@extends('japanese.base')

@section('content_header')
<wanikani-search action="{{ path('JapaneseWanikaniSearch@index') }}">
  <div class="mt-n2" style="border: 1px solid transparent; padding: .375rem 0;">&nbsp;</div>
</wanikani-search>
@endsection
