@include('tpl.form_errors')

<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Рубрика:</label>
  <div class="col-md-4">
    <div class="form-select">
      <select required class="form-control" name="category_id">
        <option value="0">Выберите рубрику...</option>
        @foreach (TorrentCategoryHelper::tree() as $id => $category)
          <option value="{{ $id }}" {{ $id == old('category_id', @$model->category_id) ? 'selected' : '' }} {{ TorrentCategoryHelper::canPost($id) ? '' : 'disabled' }}>
            {{ $category['title'] }}
          </option>
          @if (!empty($category['children']))
            @foreach ($category['children'] as $id => $category)
              <option value="{{ $id }}" {{ $id == old('category_id', @$model->category_id) ? 'selected' : '' }}>
                &nbsp;&nbsp;&nbsp;&nbsp;{{ $category['title'] }}
              </option>
            @endforeach
          @endif
        @endforeach
      </select>
    </div>
  </div>
</div>

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Название:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="title" value="{{ old('title', @$model->title) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('rto_id') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">rutracker.org topic_id:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="rto_id" value="{{ old('rto_id', @$model->rto_id) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('info_hash') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">Инфо-хэш:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="info_hash" value="{{ old('info_hash', @$model->info_hash) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('announcer') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label">Анонсер:</label>
  <div class="col-md-6">
    <input required type="text" class="form-control" name="announcer" value="{{ old('announcer', @$model->announcer) }}">
  </div>
</div>

<div class="form-group {{ $errors->has('html') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">HTML:</label>
  <div class="col-md-9">
    <textarea required class="form-control textarea-autosized js-autosize-textarea" name="html">{{ old('html', @$model->html) }}</textarea>
  </div>
</div>
