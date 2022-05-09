<?php /** @var \App\Http\Livewire\Acp\NewsForm $this */ ?>

<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php $form = LivewireForm::model($this->news); ?>

  {{ $form->text('news.title')->required() }}
  {{ $form->radio('news.status')->required()->values(App\Domain\NewsStatus::labels()) }}
  {{ $form->textarea('news.markdown')->wide()->required() }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($this->news->exists ? 'acp.save' : 'acp.news.add')
    </button>
  </div>
</form>
