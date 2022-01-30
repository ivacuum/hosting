@if($model->id)
  @livewire(App\Http\Livewire\Acp\PhotoEditForm::class, ['modelId' => $model->id])
@else
  @livewire(App\Http\Livewire\Acp\PhotoUploadForm::class)
@endif
