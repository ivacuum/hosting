<?php
/** @var \App\Trip $trip */
?>

@if ($trip->isHidden())
  @svg (eye-slash)
@elseif ($trip->isInactive())
  @svg (pencil)
@endif
