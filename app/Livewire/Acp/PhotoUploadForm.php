<?php

namespace App\Livewire\Acp;

use App\Domain\Exif\GetAltitudeInCentimetersFromGpsDataAction;
use App\Domain\Exif\GetDirectionInDegreesFromGpsDataAction;
use App\Domain\Exif\GetPointFromGpsDataAction;
use App\Domain\Exif\GetSpeedInMetersPerHourFromGpsDataAction;
use App\Domain\Exif\GetTakenAtFromExifDataAction;
use App\Domain\Exif\Jobs\DeleteTempLivewireFileJob;
use App\Domain\Exif\ReadRawExifDataAction;
use App\Domain\Life\Action\FindUploadedPhotoAction;
use App\Domain\Life\Action\ListGigsForInputSelectAction;
use App\Domain\Life\Action\ListTripsForInputSelectAction;
use App\Domain\Life\Job\StorePhotoJob;
use App\Domain\Life\Models\Gig;
use App\Domain\Life\Models\Photo;
use App\Domain\Life\Models\Trip;
use App\Domain\Life\PhotoStatus;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Authorize;
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
    use WithFileUploads;

    public $gigId;
    public $tripId;
    public int $total = 0;
    public int $processed = 0;
    public int $uploaded = 0;
    public bool $shouldOverwriteImage = false;
    public array $uploadResults = [];
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

    /** @param list<string> $filenames */
    #[Authorize('create', Photo::class)]
    public function queueFiles(array $filenames): void
    {
        foreach ($filenames as $filename) {
            $this->uploadResults[] = [
                'filename' => $filename,
                'message' => __('Ожидает загрузки'),
                'status' => 'pending',
            ];
        }

        $this->total += count($filenames);
    }

    #[Authorize('create', Photo::class)]
    public function uploadFailed(string $filename, string|null $message = null): void
    {
        $message ??= $this->getErrorBag()->first('file');

        $this->completeUpload($filename, 'error', $message ?: __('Не удалось загрузить файл.'));
        $this->resetErrorBag('file');
    }

    #[Authorize('create', Photo::class)]
    public function updatedFile(
        FindUploadedPhotoAction $findUploadedPhoto,
        GetAltitudeInCentimetersFromGpsDataAction $getAltitudeInCentimetersFromGpsData,
        GetDirectionInDegreesFromGpsDataAction $getDirectionInDegreesFromGpsData,
        GetPointFromGpsDataAction $getPointFromGpsData,
        GetSpeedInMetersPerHourFromGpsDataAction $getSpeedInMetersFromGpsData,
        GetTakenAtFromExifDataAction $getTakenAtFromExifData,
        ReadRawExifDataAction $readRawExifData,
    ): void {
        $originalFilename = $this->file instanceof TemporaryUploadedFile
            ? $this->file->getClientOriginalName()
            : __('Неизвестный файл');

        try {
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
            $rawExifData = $readRawExifData->execute($this->file->getRealPath());

            if ($photo === null) {
                /** @var Photo $photo */
                $photo = $relation->photos()->make();
                $photo->slug = $photoSlug;
                $photo->point = $getPointFromGpsData->execute($rawExifData);
                $photo->views = 0;
                $photo->status = PhotoStatus::Hidden;
                $photo->user_id = \Auth::user()->id;
            } else {
                $photo->point ??= $getPointFromGpsData->execute($rawExifData);
            }

            $photo->speed = $getSpeedInMetersFromGpsData->execute($rawExifData);
            $photo->altitude = $getAltitudeInCentimetersFromGpsData->execute($rawExifData);
            $photo->taken_at = $getTakenAtFromExifData->execute($rawExifData);
            $photo->direction = $getDirectionInDegreesFromGpsData->execute($rawExifData);
            $photo->save();

            $destinationFilePath = $relation instanceof Gig
                ? "gigs/{$relation->slug}/{$basename}"
                : "{$relation->slug}/{$basename}";

            if ($photo->wasRecentlyCreated || $this->shouldOverwriteImage) {
                dispatch(new StorePhotoJob($this->file->getRealPath(), $destinationFilePath));
            } else {
                dispatch(new DeleteTempLivewireFileJob($this->file->getFilename()));
            }

            $this->uploaded++;
            $this->completeUpload($originalFilename, 'success', $photo->slug);
        } catch (ValidationException $exception) {
            $message = collect($exception->errors())->flatten()->first() ?: $exception->getMessage();

            $this->completeUpload($originalFilename, 'error', $message);
        } catch (\Throwable $exception) {
            report($exception);

            $this->completeUpload(
                $originalFilename,
                'error',
                $exception->getMessage() ?: $exception::class,
            );
        }
    }

    protected function rules(): array
    {
        return [
            'file' => [
                'required',
                'mimetypes:image/jpeg,image/png',
                'max:20480',
            ],
            'gigId' => 'required_without:tripId',
            'tripId' => 'required_without:gigId',
        ];
    }

    private function completeUpload(string $filename, string $status, string $message): void
    {
        foreach ($this->uploadResults as $index => $result) {
            if ($result['filename'] === $filename && $result['status'] === 'pending') {
                $this->uploadResults[$index]['status'] = $status;
                $this->uploadResults[$index]['message'] = $message;
                $this->processed++;

                return;
            }
        }

        $this->uploadResults[] = compact('filename', 'message', 'status');
        $this->processed++;
    }
}
