<?php namespace App\Http\Requests;

use App\Photo;
use App\Scope\PhotoPublishedScope;
use Illuminate\Foundation\Http\FormRequest;

class PhotosMapForm extends FormRequest
{
    public Photo|null $photo = null;
    public readonly int|null $tripId;
    public readonly string|null $photoSlug;

    public function rules(): array
    {
        return [
            'photo' => 'nullable|string',
            'trip_id' => 'nullable|integer',
        ];
    }

    protected function passedValidation()
    {
        $this->tripId = $this->input('trip_id');
        $this->photoSlug = $this->input('photo');

        $this->photo = $this->photoSlug
            ? Photo::query()
                ->where('slug', $this->photoSlug)
                ->tap(new PhotoPublishedScope)
                ->first()
            : null;
    }
}
