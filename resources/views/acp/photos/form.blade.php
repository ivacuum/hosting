@if($model->id)
  @livewire(App\Livewire\Acp\PhotoEditForm::class, ['photo' => $model])
@else
  @livewire(App\Livewire\Acp\PhotoUploadForm::class, [
    'gigId' => request('gig_id'),
    'tripId' => request('trip_id'),
  ])
@endif
