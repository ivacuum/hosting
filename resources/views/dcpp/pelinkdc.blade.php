@extends('dcpp.software', [
  'meta_title' => trans('meta_title.dcpp.pelinkdc'),
  'software_title' => trans('dcpp.pelinkdc'),
  'software' => [
    ['version' => '5.95', 'id' => 78, 'size' => 24999117, 'dl_suffix' => ''],
    ['version' => '5.84', 'id' => 65, 'dl_suffix' => ''],
  ],
])

@section('about_software')
@ru
  <p><strong>PeLinkDC++</strong> — облегченная версия <a class="link" href="{{ action('Dcpp@page', 'greylinkdc') }}">GreyLinkDC++</a>. Поставляется с набором различных дополнений.</p>
@en
<p><strong>PeLinkDC++</strong> is a light version of <a class="link" href="{{ action('Dcpp@page', 'greylinkdc') }}">GreyLinkDC++</a>.</p>
@endlang
@endsection
