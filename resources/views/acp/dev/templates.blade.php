@extends('acp.dev.base')

@section('content')
<h3>Доступные шаблоны</h3>
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
