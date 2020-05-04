<div class="mb-4">
  <label class="font-bold input-required">Рубрика</label>
  <select required class="form-select" name="category_id">
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
  <x-invalid-feedback field="category_id"/>
</div>

{!! Form::text('rto_id')->required()->html() !!}

{!! Form::radio('status')->required()->values([
  App\Torrent::STATUS_HIDDEN => 'Скрыт',
  App\Torrent::STATUS_PUBLISHED => 'Опубликован',
  App\Torrent::STATUS_DELETED => 'Удален',
])->html() !!}

{!! Form::text('related_query')->html() !!}
