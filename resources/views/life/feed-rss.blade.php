<?php echo '<?xml version="1.0" encoding="utf-8"?>'."\n"; ?>
<rss version="2.0">
<channel>
  @foreach ($meta as $key => $value)
    <{{ $key }}>{{ $value }}</{{ $key }}>
  @endforeach
  @foreach ($items as $item)
    <item>
      @foreach ($item as $key => $value)
        <{{ $key }}>{{ $value }}</{{ $key }}>
      @endforeach
    </item>
  @endforeach
</channel>
</rss>
