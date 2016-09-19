<div class="modal js-modal-feedback" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ action('Ajax@feedback') }}" method="post">
        <input hidden type="text" name="mail" value="{{ old('mail') }}">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            @svg (times)
          </button>
          <h4 class="modal-title">{{ trans('life.feedback.heading') }}</h4>
        </div>
        <div class="modal-body">
          <div hidden class="h4 m-t-0 js-modal-question-text"></div>
          <input hidden class="js-modal-question-input" type="text" name="question" value="">
          <textarea required class="form-control textarea-autosized js-autosize-textarea" name="text" rows="5" placeholder="{{ trans('life.feedback.placeholder') }}"></textarea>
          <p class="help-block">{{ trans('life.feedback.help') }}</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            {{ trans('life.feedback.submit') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
