<?php namespace App\Http\Livewire\Acp;

use App\Action\ListGigsForInputSelectAction;
use App\Action\ListTripsForInputSelectAction;
use App\Domain\PhotoStatus;
use App\Gig;
use App\Photo;
use App\Spatial\Point;
use App\Trip;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Ivacuum\Generic\Services\ImageConverter;
use Ivacuum\Generic\Utilities\ExifHelper;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

/**
 * @property $gigIds
 * @property $tripIds
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

    public function getGigIdsProperty(ListGigsForInputSelectAction $listGigsForInputSelect)
    {
        return $listGigsForInputSelect->execute();
    }

    public function getTripIdsProperty(ListTripsForInputSelectAction $listTripsForInputSelect)
    {
        return $listTripsForInputSelect->execute();
    }

    public function rules()
    {
        return [
            'file' => [
                'required',
                'image',
                'mimetypes:image/jpeg,image/png',
                'max:12288',
            ],
            'gigId' => 'required_without:tripId',
            'tripId' => 'required_without:gigId',
        ];
    }

    public function updatedFile()
    {
        $this->authorize('create', Photo::class);
        $this->validate();

        if ($this->gigId) {
            $model = Gig::findOrFail($this->gigId);
        } elseif ($this->tripId) {
            $model = Trip::findOrFail($this->tripId);
        } else {
            throw new \DomainException('Нужен концерт или поездка.');
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
        $extension = str_replace('jpeg', 'jpg', strtolower($pathInfo['extension']));
        $filename = "{$pathInfo['filename']}.{$extension}";

        $folder = $model instanceof Gig
            ? "gigs/{$model->slug}"
            : $model->slug;

        \Storage::disk('photos')->putFileAs($folder, $image, $filename);

        /** @var \App\Photo $photo */
        $photo = $model->photos()->make();
        $photo->lat = $coords['lat'] ?? '';
        $photo->lon = $coords['lon'] ?? '';
        $photo->slug = "{$model->slug}/{$filename}";
        $photo->point = $photo->lat
            ? new Point($photo->lat, $photo->lon)
            : null;
        $photo->views = 0;
        $photo->status = PhotoStatus::Hidden;
        $photo->user_id = \Auth::user()->id;
        $photo->save();

        $this->thumbnails[] = $photo->slug;

        $this->uploaded++;
    }
}
