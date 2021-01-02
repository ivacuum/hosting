<div class="mb-4">
  <select required class="form-input" name="category_id">
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
  <x-invalid-feedback field="category_id"/>
</div>

<div class="mb-4">
  <input
    required
    type="text"
    class="form-input"
    name="input"
    value="{{ old('input') }}"
    placeholder="Ссылка или инфо-хэш"
  >
  <x-invalid-feedback field="input"/>
  <div class="form-help">Ссылка вида <span class="font-medium text-green-600">http://rutracker.org/forum/<wbr>viewtopic.php?t=4031882</span><br>или инфо-хэш вида <span class="font-medium text-green-600">9B5D85FFC234737E7D7C<wbr>246FECB6BB1EC5E8F0B9</span></div>
</div>
