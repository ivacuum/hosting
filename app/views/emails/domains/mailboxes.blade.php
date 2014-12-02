<body>
<pre>https://mail.{{ $domain->domain }}/
@foreach ($mailboxes as $mail)

{{ $mail['user'] }}
{{ $mail['pass'] }}
@endforeach
</pre>
</body>