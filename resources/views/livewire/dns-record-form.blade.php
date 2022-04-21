<form class="grid grid-cols-1 gap-4" wire:submit.prevent="submit">
  <?php LivewireForm::model('yandex-pdd-ns-record') ?>

  {{ LivewireForm::radio('type')->values(App\Services\YandexPdd\DnsRecordType::casesThatCanBeAdded()) }}

  {{ LivewireForm::text('subdomain') }}
  {{ LivewireForm::text('content') }}
  {{ LivewireForm::text('ttl') }}

  @if(in_array($type, ['MX', 'SRV']))
    {{ LivewireForm::text('priority') }}
  @endif

  @if($type === 'SRV')
    {{ LivewireForm::text('port') }}
    {{ LivewireForm::text('weight') }}
  @endif

  <div>
    <button type="submit" class="btn btn-primary">
      @lang('acp.save')
    </button>
  </div>
</form>
