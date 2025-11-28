@extends('life.base')
@include('livewire')

@section('content_header')
@parent
<div class="max-w-[1000px] mx-auto">
  @include('tpl.gig-timeline')
  <h1 class="text-3xl mb-2">
    <span class="font-medium tracking-tight">{{ $gig->title }}</span>
    <span class="text-base text-gray-500"><time datetime="{{ $gig->date->toDateString() }}">{{ $gig->fullDate() }}</time></span>
  </h1>
  <div class="js-trip-shortcuts">
@endsection

@section('content_footer')
  </div>
</div>

<div class="font-medium text-xl mt-12 mb-2">@ru Поделиться ссылкой @en Share @endru</div>
@include('tpl.social-buttons', ['title' => $gig->metaTitle(), 'url' => Request::url()])
@parent
@endsection
