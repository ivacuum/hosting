@extends('docs.base')

@section('content')
<h2 class="font-medium text-3xl tracking-tight mb-2">@lang('Nginx')</h2>

<x-terminal-pre>
@verbatim
<span class="text-gray-500 dark:text-white"># Проксирование файлов с S3</span>
proxy_cache_path /tmp/nginx-s3-cache levels=1:2 keys_zone=s3_cache:10m inactive=168h max_size=250m;

location / {
  try_files $uri $uri/ @s3;
}

location @s3 {
  proxy_http_version     1.1;
  proxy_set_header       Connection "";
  proxy_set_header       Host '<span class="bg-green-300 dark:bg-green-400/25 font-bold dark:text-green-400">bucket</span>.s3-eu-west-1.amazonaws.com';
  proxy_set_header       Authorization '';
  proxy_hide_header      x-amz-id-2;
  proxy_hide_header      x-amz-request-id;
  proxy_hide_header      Set-Cookie;
  proxy_ignore_headers   Set-Cookie;
  proxy_intercept_errors on;

  proxy_cache          s3_cache;
  proxy_cache_valid    200 168h;
  proxy_cache_valid    403 15m;
  proxy_cache_bypass   $arg_pass $http_cache_bypass;
  add_header           X-Cached $upstream_cache_status;
  expires              30d;

  proxy_pass           https://<span class="bg-green-300 dark:bg-green-400/25 font-bold dark:text-green-400">bucket</span>.s3-eu-west-1.amazonaws.com;
}
@endverbatim
</x-terminal-pre>
@endsection
