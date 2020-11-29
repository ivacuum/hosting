<?php namespace App\Http\Requests;

use App\Rules\Email;
use Ivacuum\Generic\Http\FormRequest;

class PhotosMapForm extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function photoSlug()
    {
        return $this->input('photo');
    }

    public function rules(): array
    {
        return [
            'photo' => '',
            'trip_id' => '',
        ];
    }

    public function tripId()
    {
        return $this->input('trip_id');
    }
}
