@extends('base', [
  'content_container_id' => 'vue_app',
])

@push('js_vendor')
<script>
<?php echo 'window.i18nData = '.json_encode([
  $locale => array_merge(
    ViewHelper::prependTransKeysForJson('japanese', true)
  )
]); ?>
</script>
@endpush
