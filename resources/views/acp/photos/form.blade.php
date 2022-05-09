@if($model->id)
  @livewire(App\Http\Livewire\Acp\PhotoEditForm::class, ['photo' => $model])
@else
  @livewire(App\Http\Livewire\Acp\PhotoUploadForm::class, [
    'gigId' => request('gig_id'),
    'tripId' => request('trip_id'),
  ])
@endif
