<?php
/**
 * @var \App\Domain\Life\Models\Photo $photo
 * @var \App\Domain\Life\Models\Photo $next
 * @var \App\Domain\Life\Models\Photo $prev
 */
?>

@extends('photos.base')

@push('js')
<script type="module">
Mousetrap.bind('left', () => {
  document.dispatchEvent(new Event('shortcuts.to_prev_page'))
})

Mousetrap.bind('right', () => {
  document.dispatchEvent(new Event('shortcuts.to_next_page'))
})
</script>
@endpush

@section('content')
@livewire(App\Domain\Life\Livewire\PhotoShow::class, [
  'photo' => $photo,
  'next' => $next,
  'prev' => $prev,
  'cityId' => $cityId,
  'countryId' => $countryId,
  'tagId' => $tagId,
  'tripId' => $tripId,
])
@endsection
