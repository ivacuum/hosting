<?php
/** @var \App\Gig $gig */
?>

@if ($gig->isHidden())
  <span title="Заметка пишется">
    @svg (pencil)
  </span>
@elseif (!$gig->meta_image)
  <span title="Недостает обложки">
    @svg (picture-o)
  </span>
@endif
