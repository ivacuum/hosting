<div class="form-group">
  <select required class="custom-select {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id">
    <option value="">Выберите рубрику...</option>
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
  @if ($errors->has('category_id'))
    <div class="invalid-feedback">{{ $errors->first('category_id') }}</div>
  @endif
</div>

<div class="form-group">
  <input required class="form-control {{ $errors->has('input') ? 'is-invalid' : '' }}" name="input" value="{{ old('input') }}" placeholder="Ссылка или инфо-хэш">
  @if ($errors->has('input'))
    <div class="invalid-feedback">{{ $errors->first('input') }}</div>
  @endif
  <div class="form-help">Ссылка вида <span class="text-success">http://rutracker.org/forum/<wbr>viewtopic.php?t=4031882</span><br>или инфо-хэш вида <span class="text-success">9B5D85FFC234737E7D7C<wbr>246FECB6BB1EC5E8F0B9</span></div>
</div>
