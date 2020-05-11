<?php /** @var \App\Trip $trip */ ?>

@if ($trip->isHidden())
  <span title="Заметка скрыта">
    @svg (eye-slash)
  </span>
@elseif ($trip->isInactive())
  <span title="Заметка пишется">
    @svg (pencil)
  </span>
@elseif (!$trip->meta_image)
  <span title="Недостает обложки">
    @svg (picture-o)
  </span>
@endif
