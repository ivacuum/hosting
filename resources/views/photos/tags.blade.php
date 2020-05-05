@extends('photos.base')

@section('content')
<div class="column-width-48">
  <?php $initial = $currentInitial = false ?>
  <?php /** @var App\Tag $tag */ ?>
  @foreach ($tags as $tag)
    <?php $currentInitial = $tag->initial() ?>
    <div class="city-entry relative ml-6 pb-2">
      @if ($initial !== $currentInitial)
        <span class="absolute font-bold uppercase -ml-6">{{ $currentInitial }}</span>
      @endif
      <a class="link" href="{{ path([App\Http\Controllers\Photos::class, 'tag'], $tag) }}">#{{ $tag->title }}</a>
      <span class="text-xs text-muted">{{ $tag->photos_published_count }}</span>
    </div>
    <?php $initial = $currentInitial ?>
  @endforeach
</div>
@endsection
