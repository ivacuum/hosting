<?php namespace App\Http\Requests;

use App\Domain\PhotoStatus;
use App\Photo;
use Illuminate\Foundation\Http\FormRequest;

class PhotosMapForm extends FormRequest
{
    public ?Photo $photo;
    public readonly ?int $tripId;
    public readonly ?string $photoSlug;

    public function authorize(): bool
    {
        return true;
    }

    protected function passedValidation()
    {
        $this->tripId = $this->input('trip_id');
        $this->photoSlug = $this->input('photo');

        $this->photo = $this->photoSlug
            ? Photo::query()
                ->where('slug', $this->photoSlug)
                ->where('status', PhotoStatus::Published)
                ->first()
            : null;
    }

    public function rules(): array
    {
        return [
            'photo' => 'nullable|string',
            'trip_id' => 'nullable|integer',
        ];
    }
}
