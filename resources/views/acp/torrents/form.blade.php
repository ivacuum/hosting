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

{!! Form::text('rto_id')->required()->html() !!}

{!! Form::radio('status')->required()->values([
  App\Torrent::STATUS_HIDDEN => 'Скрыт',
  App\Torrent::STATUS_PUBLISHED => 'Опубликован',
  App\Torrent::STATUS_DELETED => 'Удален',
])->html() !!}
