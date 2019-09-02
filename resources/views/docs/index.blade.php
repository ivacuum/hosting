@extends('docs.base', [
  'meta_title' => 'Документация',
])

@section('content')
<div class="h2">Документация</div>
<p>Подборка различных инструкций.</p>

<section class="pt-8">
  <div class="h3">Справка</div>
  <div><a class="link" href="/docs/trips">Поездки</a></div>
</section>

<section class="pt-12">
  <div class="h3">Хостинг</div>
  <div><a class="link" href="/docs/amazon-s3">Amazon S3</a></div>
  <div><a class="link" href="/docs/freebsd">FreeBSD</a></div>
  <div><a class="link" href="/docs/nginx">Nginx</a></div>
</section>

<section class="pt-12">
  <div class="h3">Веб-технологии</div>
  <div>
    <a class="link" href="https://developers.whatwg.org/" rel="nofollow">
      HTML Standart
      @svg (external-link)
    </a>
  </div>
  <div>
    <a class="link" href="http://www.phptherightway.com/" rel="nofollow">
      PHP: The Right Way
      @svg (external-link)
    </a>
  </div>
</section>
@endsection
