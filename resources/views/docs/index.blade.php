@extends('docs.base')

@section('content')
<div class="font-medium text-3xl tracking-tight mb-2">@lang('Документация')</div>
<p>Подборка различных инструкций.</p>

<section class="pt-8">
  <div class="font-medium text-2xl mb-2">@lang('Справка')</div>
  <div><a class="link" href="@lng/docs/trips">@lang('Поездки')</a></div>
</section>

<section class="pt-12">
  <div class="font-medium text-2xl mb-2">@lang('Хостинг')</div>
  <div><a class="link" href="@lng/docs/amazon-s3">@lang('Amazon S3')</a></div>
  <div><a class="link" href="@lng/docs/freebsd">@lang('FreeBSD')</a></div>
  <div><a class="link" href="@lng/docs/nginx">@lang('Nginx')</a></div>
</section>

<section class="pt-12">
  <div class="font-medium text-2xl mb-2">Веб-технологии</div>
  <div>
    <a class="link" href="https://developers.whatwg.org/" rel="nofollow">
      HTML Standart
      @svg (external-link)
    </a>
  </div>
  <div>
    <a class="link" href="https://phptherightway.com/" rel="nofollow">
      PHP: The Right Way
      @svg (external-link)
    </a>
  </div>
</section>
@endsection
