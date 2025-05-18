@extends('docs.base')

@section('content')
@component('documentation-article')
@slot('title')
  @lang('Документация')
@endslot

<p>В разделе справка рассказано как пользоваться различными разделами данного сайта.</p>
<p>В разделе хостинг представлена подборка различных инструкций и заготовок, чтобы экономить время при решении повторяющихся задач и проблем.</p>

<h2>Веб-технологии</h2>
<div>
  <a class="link" href="https://developers.whatwg.org/" rel="nofollow">
    HTML Standard
    @svg (external-link)
  </a>
</div>
<div>
  <a class="link" href="https://phptherightway.com/" rel="nofollow">
    PHP: The Right Way
    @svg (external-link)
  </a>
</div>
@endcomponent
@endsection
