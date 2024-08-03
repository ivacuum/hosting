HTTP request received.
@if (defined('LARAVEL_START'))
  Response successfully rendered in {{ round((microtime(true) - LARAVEL_START) * 1000) }}ms.
@endif
