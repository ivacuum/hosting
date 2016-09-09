@extends('docs.base', [
  'meta_title' => 'Документация',
])

@section('content')
<div class="h2 m-t-0">Документация</div>
<p>Подборка различных инструкций.</p>

<section>
  <div class="h3 m-t-0">Хостинг</div>
  <ul class="list-unstyled">
    <li><a class="link" href="/docs/amazon-s3">Amazon S3</a></li>
    <li><a class="link" href="/docs/freebsd">FreeBSD</a></li>
    <li><a class="link" href="/docs/nginx">Nginx</a></li>
  </ul>
</section>

<section>
  <div class="h3 m-t-0">Веб-технологии</div>
  <ul class="list-unstyled">
    <li>
      <a class="link" href="https://developers.whatwg.org/">
        HTML Standart
        @svg (external-link)
      </a>
    </li>
    <li>
      <a class="link" href="http://www.phptherightway.com/">
        PHP: The Right Way
        @svg (external-link)
      </a>
    </li>
  </ul>
</section>
@endsection
