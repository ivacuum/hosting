<form class="inline" method="post" action="{{ $model->alias?->cms_url ?? $model->cms_url }}" target="_blank">
  @if (in_array($model->cms_type, ['korden.cms', 'simpla']))
    <input type="hidden" name="login" value="{{ $model->cms_user }}">
    <input type="hidden" name="password" value="{{ $model->cms_pass }}">
    <button name="loginsubmit" class="{{ $cmsButtonClass ?? '' }}">
      @svg (sign-in)
    </button>
  @elseif (in_array($model->alias?->cms_type, ['korden.cms', 'simpla']))
    <input type="hidden" name="login" value="{{ $model->alias->cms_user }}">
    <input type="hidden" name="password" value="{{ $model->alias->cms_pass }}">
    <button name="loginsubmit" class="{{ $cmsButtonClass ?? '' }}">
      @svg (sign-in)
    </button>
  @elseif ($model->cms_type == 'integrium')
    <input type="hidden" name="login" value="{{ $model->cms_user }}">
    <input type="hidden" name="pwd" value="{{ $model->cms_pass }}">
    <button class="{{ $cmsButtonClass ?? '' }}">
      @svg (sign-in)
    </button>
  @elseif ($model->alias?->cms_type === 'integrium')
    <input type="hidden" name="login" value="{{ $model->alias->cms_user }}">
    <input type="hidden" name="pwd" value="{{ $model->alias->cms_pass }}">
    <button class="{{ $cmsButtonClass ?? '' }}">
      @svg (sign-in)
    </button>
  @elseif ($model->cms_type == 'modx')
    <input type="hidden" name="username" value="{{ $model->cms_user }}">
    <input type="hidden" name="password" value="{{ $model->cms_pass }}">
    <input type="hidden" name="rememberme" value="1">
    <button name="login" class="{{ $cmsButtonClass ?? '' }}" value="1">
      @svg (sign-in)
    </button>
  @elseif ($model->alias?->cms_type == 'modx')
    <input type="hidden" name="username" value="{{ $model->alias->cms_user }}">
    <input type="hidden" name="password" value="{{ $model->alias->cms_pass }}">
    <input type="hidden" name="rememberme" value="1">
    <button name="login" class="{{ $cmsButtonClass ?? '' }}" value="1">
      @svg (sign-in)
    </button>
  @endif
</form>
