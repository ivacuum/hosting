@extends('docs.base')

@section('content')
<h2>@lang('Amazon S3')</h2>
<p><a class="link" href="https://awspolicygen.s3.amazonaws.com/policygen.html">Официальный генератор политик доступа</a>.</p>

<x-terminal-pre>
<span class="text-muted"># Политика свободного чтения</span>
{
  "Version": "2012-10-17",
  "Id": "<span class="bg-green-300 font-bold">Readable Policy Name</span>",
  "Statement": [
    {
      "Sid": "Stmt1420183261977",
      "Effect": "Allow",
      "Principal": "*",
      "Action": "s3:GetObject",
      "Resource": "arn:aws:s3:::<span class="bg-green-300 font-bold">bucket</span>/*"
    }
  ]
}
</x-terminal-pre>
@endsection
