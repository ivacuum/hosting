<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php LivewireForm::model(new App\DcppHub); ?>

  {{ LivewireForm::text('title')->required()->html() }}
  {{ LivewireForm::text('address')->required()->html() }}
  {{ LivewireForm::text('port')->required()->html() }}

  {{ LivewireForm::radio('status')->required()->values(App\Domain\DcppHubStatus::labels())->html() }}

  <div class="sticky-bottom-buttons">
    <button type="submit" class="btn btn-primary">
      @lang($modelId ? 'acp.save' : 'acp.dcpp-hubs.add')
    </button>
  </div>
</form>
