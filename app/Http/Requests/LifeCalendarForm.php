<?php namespace App\Http\Requests;

use App\Scope\TripNotToKalugaScope;
use App\Scope\TripOfAdminScope;
use App\Scope\TripVisibleScope;
use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class LifeCalendarForm extends AbstractForm
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
            ->tap(new TripOfAdminScope)
            ->tap(new TripNotToKalugaScope)
            ->when($this->includeOnlyVisibleTrips(), fn (Builder $query) => $query->tap(new TripVisibleScope))
            ->orderBy('date_start')
            ->get();
    }
}
