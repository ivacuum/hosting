<?php namespace App\Http\Requests;

use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class LifeCalendarForm extends AbstractRequest
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

    public function trips()
    {
        return Trip::query()
            ->where('user_id', 1)
            ->where('city_id', '<>', 1)
            ->when($this->includeOnlyVisibleTrips(), fn (Builder $query) => $query->visible())
            ->orderBy('date_start')
            ->get();
    }
}
