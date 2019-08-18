<?php
/** @var string $locale */
?>
@extends('base', [
  'websockets' => Auth::check(),
  'content_container_id' => 'vue_app',
  'no_language_selector' => $locale === 'ru',
])

@push('js_vendor')
<script>
window.AppData = JSON.parse('<?= json_encode([
  'categoryList' => TorrentCategoryHelper::list(true),
  'categoryTree' => TorrentCategoryHelper::tree(),
  'categoryStats' => App\Torrent::statsByCategories(),
  'test' => "'me",
], JSON_HEX_APOS) ?>')

window.i18nData = JSON.parse('<?= json_encode([
  $locale => array_merge(
    ViewHelper::prependTransKeysForJson('comments', true),
    ViewHelper::prependTransKeysForJson('torrents', true)
  )
], JSON_HEX_APOS) ?>')
</script>
@endpush