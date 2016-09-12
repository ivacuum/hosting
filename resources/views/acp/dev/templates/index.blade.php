@extends('acp.dev.base')

@section('content')
<h2 class="m-t-0">Доступные шаблоны</h2>
<ul>
  @foreach ($templates as $template)
    <li>
      <a class="link" href="{{ action("$self@template", $template)}}">
        {{ $template }}
      </a>
    </li>
  @endforeach
</ul>
@endsection
