@extends(view()->exists("$tpl.base") ? "$tpl.base" : 'acp.layout')

<?php /** @var $model */ ?>
<?php Form::model($model); ?>

@section('content')
<form
  action="{{ path([$controller, 'update'], $model) }}"
  class="mt-4"
  method="post"
  enctype="multipart/form-data"
>
  {{ ViewHelper::inputHiddenMail() }}

  @include("$tpl.form")

  <div class="sticky-bottom-buttons">
    <button class="btn btn-primary">
      @lang('acp.save')
    </button>
    <button name="_save" class="btn btn-default">
      @lang('acp.apply')
    </button>
  </div>

  @include('acp.tpl.hidden_fields', ['method' => 'put'])
</form>
@endsection
