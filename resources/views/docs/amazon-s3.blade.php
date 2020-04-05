@extends('docs.base', [
  'metaTitle' => 'Amazon S3',

  'breadcrumbs' => [
    ['title' => 'Документация', 'url' => 'docs'],
    ['title' => 'Amazon S3'],
  ]
])

@section('content')
<h2>Amazon S3</h2>

<x-terminal-pre>
<span class="text-muted"># Политика свободного чтения</span>
{
  "Version": "2008-10-17",
  "Id": "Policy1420183272983",
  "Statement": [
    {
      "Sid": "Stmt1420183261977",
      "Effect": "Allow",
      "Principal": {
        "AWS": "*"
      },
      "Action": "s3:GetObject",
      "Resource": "arn:aws:s3:::«bucket»/*"
    }
  ]
}
</x-terminal-pre>
@endsection
