@extends('torrents.base')

@section('content')
<div class="row">
  <?php
  $i = 0;
  $newlines_at = [0, 3];
  ?>
  @foreach ($tree as $id => $category)
    @if ($i > 0 && in_array($i, $newlines_at))
      </div>
    @endif
    @if (in_array($i, $newlines_at))
      <div class="col-sm-6 m-b-1">
    @endif
    <h3><a class="link" href="{{ action("$self@category", $id) }}">{{ $category['title'] }}</a></h3>
    @if (!empty($category['children']))
      @foreach ($category['children'] as $id => $child)
        <div>
          <a class="link" href="{{ action("$self@category", $id) }}">{{ $child['title'] }}</a>
          @if (!empty($stats[$id]))
            <span class="text-muted">{{ $stats[$id] }}</span>
          @endif
        </div>
      @endforeach
    @endif
    @if ($loop->last)
      </div>
    @endif
    @php ($i++)
  @endforeach
</div>
@endsection
