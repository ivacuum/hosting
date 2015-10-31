@extends('docs.base', [
  'meta_title' => 'Amazon S3',

  'breadcrumbs' => [
    ['title' => 'Документация', 'url' => 'docs'],
    ['title' => 'Amazon S3'],
  ]
])

@section('content')
<h2>Amazon S3</h2>

<div class="shortcuts-item">
<pre class="terminal">
<span class="terminal-comment"># Политика свободного чтения</span>
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
			"Resource": "arn:aws:s3:::vacuum.life/*"
		}
	]
}
</pre>
</div>
@stop
