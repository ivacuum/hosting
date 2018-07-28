@extends('base', [
  'body_classes' => '',
])

@section('body')
<div id="app"></div>

<script>
<?php echo 'window.i18nData = '.json_encode([
  $locale => array_merge(
    trans('acp'),
    ViewHelper::prependTransKeysForJson('menu'),
    ViewHelper::prependTransKeysForJson('model')
  )
]); ?>
</script>
@endsection
