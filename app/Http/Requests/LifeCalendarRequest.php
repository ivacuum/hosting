<?php namespace App\Http\Requests;

class LifeCalendarRequest extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function includeOnlyVisibleTrips(): bool
    {
        $user = $this->userModel();

        return $user === null
            || !$user->isAdmin();
    }

    public function rules(): array
    {
        return [];
    }
}
