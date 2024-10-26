<?php

namespace App\Livewire\Acp;

use App\Action\FindUploadedPhotoAction;
use App\Action\ListGigsForInputSelectAction;
use App\Action\ListTripsForInputSelectAction;
use App\Domain\Exif\GetPointFromGpsDataAction;
use App\Domain\Exif\ReadRawExifDataAction;
use App\Domain\PhotoStatus;
use App\Gig;
use App\Jobs\StorePhotoJob;
use App\Photo;
use App\Trip;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

/**
 * @property \Illuminate\Support\Collection $gigIds
 * @property \Illuminate\Support\Collection $tripIds
 */
class PhotoUploadForm extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public $gigId;
    public $tripId;
    public int $total = 0;
    public int $uploaded = 0;
    public array $thumbnails = [];
    public TemporaryUploadedFile|string|null $file = null;

    #[Computed]
    public function gigIds(): Collection
    {
        return app(ListGigsForInputSelectAction::class)->execute();
    }

    #[Computed]
    public function tripIds(): Collection
    {
        return app(ListTripsForInputSelectAction::class)->execute();
    }

    public function updatedFile(
        FindUploadedPhotoAction $findUploadedPhoto,
        GetPointFromGpsDataAction $getPointFromGpsData,
        ReadRawExifDataAction $readRawExifData,
    ) {
        $this->authorize('create', Photo::class);
        $this->validate();

        if ($this->gigId) {
            $relation = Gig::query()->findOrFail($this->gigId);
        } elseif ($this->tripId) {
            $relation = Trip::query()->findOrFail($this->tripId);
        } else {
            throw new \DomainException('Нужно выбрать концерт или поездку.');
        }

        $filename = pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME);
        $basename = "{$filename}.jpg";
        $photoSlug = "{$relation->slug}/{$basename}";

        $photo = $findUploadedPhoto->execute(\Auth::user()->id, $relation, $basename);

        if ($photo === null) {
            /** @var \App\Photo $photo */
            $photo = $relation->photos()->make();
            $photo->slug = $photoSlug;
            $photo->point = $getPointFromGpsData->execute($readRawExifData->execute($this->file->getRealPath()));
            $photo->views = 0;
            $photo->status = PhotoStatus::Hidden;
            $photo->user_id = \Auth::user()->id;
            $photo->save();
        }

        $destinationFilePath = $relation instanceof Gig
            ? "gigs/{$relation->slug}/{$basename}"
            : "{$relation->slug}/{$basename}";

        dispatch(new StorePhotoJob($this->file->getRealPath(), $destinationFilePath));

        $this->thumbnails[] = $photo->slug;
        $this->uploaded++;
    }

    protected function rules()
    {
        return [
            'file' => [
                'required',
                'mimetypes:image/heic,image/jpeg,image/png,image/webp',
                'max:12288',
            ],
            'gigId' => 'required_without:tripId',
            'tripId' => 'required_without:gigId',
        ];
    }
}
