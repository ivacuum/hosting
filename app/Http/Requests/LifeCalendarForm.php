<?php

namespace App\Http\Requests;

use App\Scope\TripNotToKalugaScope;
use App\Scope\TripOfAdminScope;
use App\Scope\TripVisibleScope;
use App\Trip;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

class LifeCalendarForm extends FormRequest
{
    public User|null $user = null;

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

    protected function passedValidation()
    {
        $this->user = $this->user();
    }

    private function includeOnlyVisibleTrips(): bool
    {
        return $this->user === null
            || !$this->user->isAdmin();
    }
}
