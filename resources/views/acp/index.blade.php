<?php
/** @var string $locale */
?>
@extends('base', [
  'body_classes' => '',
])

@section('body')
<div id="vue_acp"></div>

<script>
window.i18nData = JSON.parse('<?= json_encode([
  $locale => array_merge(
    trans('acp'),
    ViewHelper::prependTransKeysForJson('menu'),
    ViewHelper::prependTransKeysForJson('model')
  )
], JSON_HEX_APOS) ?>')

window.singularAndPluralForms = JSON.parse('<?= json_encode(ViewHelper::modelsSingularAndPluralForms(), JSON_HEX_APOS) ?>')
</script>
@endsection
