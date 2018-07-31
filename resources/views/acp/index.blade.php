@extends('base', [
  'body_classes' => '',
])

@section('body')
<div id="vue_acp"></div>

<script>
<?php echo 'window.i18nData = '.json_encode([
  $locale => array_merge(
    trans('acp'),
    ViewHelper::prependTransKeysForJson('menu'),
    ViewHelper::prependTransKeysForJson('model')
  )
]); ?>

<?php echo 'window.singularAndPluralForms = '.json_encode(ViewHelper::modelsSingularAndPluralForms()); ?>
</script>
@endsection
