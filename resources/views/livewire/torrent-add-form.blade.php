<?php /** @var \App\Http\Livewire\TorrentAddForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <div>
    <div class="relative">
      <input
        required
        type="text"
        class="form-input pr-10"
        wire:model="input"
        placeholder="Ссылка или инфо-хэш"
      >
      <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
        <div wire:loading.delay>
          <svg
            class="animate-spin h-5 w-5 text-gray-600"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
          >
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path
              class="opacity-75"
              fill="currentColor"
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            ></path>
          </svg>
        </div>
      </div>
    </div>
    <x-invalid-feedback field="input"/>
    <div class="form-help">
      Ссылка вида <span class="font-medium text-emerald-600">https://rutracker.org/forum/<wbr>viewtopic.php?t=4031882</span><br>или инфо-хэш вида
      <span class="font-medium text-emerald-600">9B5D85FFC234737E7D7C<wbr>246FECB6BB1EC5E8F0B9</span>
    </div>
  </div>

  @if ($this->topicId)
    <div class="block w-full border-2 border-gray-300 dark:border-slate-700 border-dashed rounded-lg p-4 bg-gray-50 dark:bg-slate-800">
      <div class="font-bold">{{ $this->title }}</div>
      <div class="text-gray-500 mt-1">{{ ViewHelper::size($this->size) }}</div>
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

    @if ($this->categoryId)
      <div>
        <button class="btn btn-primary" wire:loading.attr="disabled">
          @lang('Добавить раздачу')
        </button>
      </div>
    @endif
  @endif
</form>
