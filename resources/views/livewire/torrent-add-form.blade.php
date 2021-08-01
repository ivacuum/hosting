<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <div>
    <input
      required
      type="text"
      class="form-input"
      wire:model="input"
      placeholder="Ссылка или инфо-хэш"
    >
    <x-invalid-feedback field="input"/>
    <div class="form-help">
      Ссылка вида <span class="font-medium text-green-600">https://rutracker.org/forum/<wbr>viewtopic.php?t=4031882</span><br>или инфо-хэш вида
      <span class="font-medium text-green-600">9B5D85FFC234737E7D7C<wbr>246FECB6BB1EC5E8F0B9</span>
    </div>
  </div>

  @if ($topicId)
    <div class="block w-full border-2 border-gray-300 border-dashed rounded-lg p-4 bg-gray-50">
      <div class="font-bold">{{ $title }}</div>
      <div class="text-gray-500 mt-1">{{ ViewHelper::size($size) }}</div>
    </div>

    <div>
      <select required class="form-input" wire:model="categoryId">
        <option value="">Выберите рубрику...</option>
        @foreach (TorrentCategoryHelper::tree() as $id => $category)
          <option value="{{ $id }}" {{ !empty($category['children']) ? 'disabled' : '' }}>
            {{ $category['title'] }}
          </option>
          @if (!empty($category['children']))
            @foreach ($category['children'] as $id => $category)
              <option value="{{ $id }}">
                &nbsp;&nbsp;&nbsp;&nbsp;{{ $category['title'] }}
              </option>
            @endforeach
          @endif
        @endforeach
      </select>
      <x-invalid-feedback field="categoryId"/>
    </div>

    @if ($categoryId)
      <div>
        <button class="btn btn-primary">
          @lang('Добавить раздачу')
        </button>
      </div>
    @endif
  @endif
</form>
