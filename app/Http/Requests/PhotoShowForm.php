<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class PhotoShowForm extends FormRequest
{
    public User $user;
    public readonly string $email;
    public readonly string $username;

    public readonly int|null $tagId;
    public readonly int|null $cityId;
    public readonly int|null $tripId;
    public readonly int|null $countryId;

    public function rules(): array
    {
        return [];
    }

    protected function passedValidation()
    {
        $this->tagId = $this->input('tag_id');
        $this->cityId = $this->input('city_id');
        $this->tripId = $this->input('trip_id');
        $this->countryId = $this->input('country_id');
    }
}
