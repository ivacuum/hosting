@include('tpl.form_errors')

<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
  <div class="col-md-4">
    <div class="form-select">
      <select class="form-control" name="category_id">
        <option value="0">Выберите рубрику...</option>
        @foreach (TorrentCategoryHelper::tree() as $id => $category)
          <option value="{{ $id }}" {{ $id == old('category_id', @$model->category_id) ? 'selected' : '' }} {{ !empty($category['children']) ? 'disabled' : '' }}>
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

<div class="form-group {{ $errors->has('input') ? 'has-error' : '' }}">
  <div class="col-md-6">
    <input required type="text" class="form-control" name="input" value="{{ old('input') }}" placeholder="Ссылка или инфо-хэш">
    <p class="help-block">Ссылка вида <span class="text-success">http://rutracker.org/forum/<wbr>viewtopic.php?t=4031882</span><br>или инфо-хэш вида <span class="text-success">9B5D85FFC234737E7D7C<wbr>246FECB6BB1EC5E8F0B9</span></p>
  </div>
</div>
