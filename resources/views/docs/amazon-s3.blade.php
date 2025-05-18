@extends('docs.base')

@section('content')
@component('documentation-article')
@slot('title')
  @lang('Amazon S3')
@endslot

<h2>Политика свободного чтения</h2>
<p>Она позволяет читать файлы без API-ключа. Это открывает возможность ставить nginx в качестве прокси перед S3.</p>
<p><a class="link" href="https://awspolicygen.s3.amazonaws.com/policygen.html">Официальный генератор политик доступа</a>.</p>

<x-terminal-pre>
{
  "Version": "2012-10-17",
  "Id": "<span class="bg-green-300 dark:bg-green-400/25 font-bold dark:text-green-400">Readable Policy Name</span>",
  "Statement": [
    {
      "Sid": "Stmt1420183261977",
      "Effect": "Allow",
      "Principal": "*",
      "Action": "s3:GetObject",
      "Resource": "arn:aws:s3:::<span class="bg-green-300 dark:bg-green-400/25 font-bold dark:text-green-400">bucket</span>/*"
    }
  ]
}
</x-terminal-pre>
@endcomponent
@endsection
