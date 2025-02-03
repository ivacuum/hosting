@extends('acp.base')

<?php /** @var $model */ ?>
<?php Form::model($model); ?>

@section('content')
<h3 class="font-medium text-2xl mb-2">
  @include('acp.tpl.back')
  @lang("$tpl.create")
</h3>
<form action="{{ path([$controller, 'store']) }}" class="mt-4" method="post" enctype="multipart/form-data">
  {{ ViewHelper::inputHiddenMail() }}

  @include("$tpl.form")
  @include('acp.tpl.hidden_fields')

  <div class="sticky-bottom-buttons">
    <button class="btn btn-primary">
      @lang("$tpl.add")
    </button>
  </div>
</form>
@endsection
