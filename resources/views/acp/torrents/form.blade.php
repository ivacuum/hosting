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

{!! Form::text('title')->required()->html() !!}

{!! Form::text('rto_id')->required()->html() !!}

{!! Form::text('info_hash')->required()->html() !!}

{!! Form::text('announcer')->html() !!}

{!! Form::radio('status')->required()->values([
  App\Torrent::STATUS_HIDDEN => 'Скрыт',
  App\Torrent::STATUS_PUBLISHED => 'Опубликован',
  App\Torrent::STATUS_DELETED => 'Удален',
])->html() !!}

<div class="form-group {{ $errors->has('html') ? 'has-error' : '' }}">
  <label class="col-md-3 control-label required">HTML:</label>
  <div class="col-md-9">
    <textarea required class="form-control textarea-autosized js-autosize-textarea" name="html">{{ old('html', @$model->html) }}</textarea>
  </div>
</div>
