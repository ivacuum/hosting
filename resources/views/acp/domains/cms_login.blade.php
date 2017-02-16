<form class="d-inline" method="post" action="{{ $model->alias_id ? $model->alias->cms_url : $model->cms_url }}" target="_blank">
  @if ($model->cms_type == 'korden.cms' or $model->cms_type == 'simpla')
    <input type="hidden" name="login" value="{{ $model->cms_user }}">
    <input type="hidden" name="password" value="{{ $model->cms_pass }}">
    <button type="submit" name="loginsubmit" class="{{ $cms_button_class or '' }}">
      @svg (sign-in)
    </button>
  @elseif ($model->alias_id and ($model->alias->cms_type == 'korden.cms' or $model->alias->cms_type == 'simpla'))
    <input type="hidden" name="login" value="{{ $model->alias->cms_user }}">
    <input type="hidden" name="password" value="{{ $model->alias->cms_pass }}">
    <button type="submit" name="loginsubmit" class="{{ $cms_button_class or '' }}">
      @svg (sign-in)
    </button>
  @elseif ($model->cms_type == 'integrium')
    <input type="hidden" name="login" value="{{ $model->cms_user }}">
    <input type="hidden" name="pwd" value="{{ $model->cms_pass }}">
    <button type="submit" class="{{ $cms_button_class or '' }}">
      @svg (sign-in)
    </button>
  @elseif ($model->alias_id and $model->alias->cms_type == 'integrium')
    <input type="hidden" name="login" value="{{ $model->alias->cms_user }}">
    <input type="hidden" name="pwd" value="{{ $model->alias->cms_pass }}">
    <button type="submit" class="{{ $cms_button_class or '' }}">
      @svg (sign-in)
    </button>
  @elseif ($model->cms_type == 'modx')
    <input type="hidden" name="username" value="{{ $model->cms_user }}">
    <input type="hidden" name="password" value="{{ $model->cms_pass }}">
    <input type="hidden" name="rememberme" value="1">
    <button type="submit" name="login" class="{{ $cms_button_class or '' }}" value="1">
      @svg (sign-in)
    </button>
  @elseif ($model->alias_id and $model->alias->cms_type == 'modx')
    <input type="hidden" name="username" value="{{ $model->alias->cms_user }}">
    <input type="hidden" name="password" value="{{ $model->alias->cms_pass }}">
    <input type="hidden" name="rememberme" value="1">
    <button type="submit" name="login" class="{{ $cms_button_class or '' }}" value="1">
      @svg (sign-in)
    </button>
  @endif
</form>
