<?php echo '<?xml version="1.0" encoding="utf-8"?>'."\n"; ?>
<rss version="2.0">
<channel>
  @foreach ($meta as $key => $value)
    <{{ $key }}>{!! htmlspecialchars($value, ENT_XML1 | ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') !!}</{{ $key }}>
  @endforeach
  @foreach ($items as $item)
    <item>
      @foreach ($item as $key => $value)
        <{{ $key }}>{!! htmlspecialchars($value, ENT_XML1 | ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') !!}</{{ $key }}>
      @endforeach
    </item>
  @endforeach
</channel>
</rss>
