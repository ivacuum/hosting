<?php

namespace App\Livewire\Acp;

use App\Action\FindUploadedPhotoAction;
use App\Action\ListGigsForInputSelectAction;
use App\Action\ListTripsForInputSelectAction;
use App\Domain\PhotoStatus;
use App\Gig;
use App\Photo;
use App\Spatial\Point;
use App\Trip;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Ivacuum\Generic\Services\ImageConverter;
use Ivacuum\Generic\Utilities\ExifHelper;
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

    public function updatedFile(FindUploadedPhotoAction $findUploadedPhoto)
    {
        $this->authorize('create', Photo::class);
        $this->validate();

        if ($this->gigId) {
            $model = Gig::query()->findOrFail($this->gigId);
        } elseif ($this->tripId) {
            $model = Trip::query()->findOrFail($this->tripId);
        } else {
            throw new \DomainException('Нужно выбрать концерт или поездку.');
        }

        try {
            $coords = ExifHelper::latLon(exif_read_data($this->file->getRealPath()));
        } catch (\Throwable) {
            $coords = ['lat' => null, 'lon' => null];
        }

        $image = (new ImageConverter)
            ->autoOrient()
            ->resize(2000, 2000)
            ->quality(75)
            ->convert($this->file->getRealPath());

        $pathInfo = pathinfo($this->file->getClientOriginalName());
        $filename = "{$pathInfo['filename']}.{$image->getExtension()}";

        $folder = $model instanceof Gig
            ? "gigs/{$model->slug}"
            : $model->slug;

        \Storage::disk('photos')->putFileAs($folder, $image, $filename);

        $photoSlug = "{$model->slug}/{$filename}";

        $photo = $findUploadedPhoto->execute(\Auth::user()->id, $model, $photoSlug);

        if ($photo === null) {
            $lat = $coords['lat'] ?? null;
            $lon = $coords['lon'] ?? null;

            /** @var \App\Photo $photo */
            $photo = $model->photos()->make();
            $photo->slug = $photoSlug;
            $photo->point = $lat && $lon
                ? new Point($lat, $lon)
                : null;
            $photo->views = 0;
            $photo->status = PhotoStatus::Hidden;
            $photo->user_id = \Auth::user()->id;
            $photo->save();
        }

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
