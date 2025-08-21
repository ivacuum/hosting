<?php

namespace App\Http\Requests;

use App\Domain\Life\Models\Trip;
use App\Domain\Life\Scope\TripNotToKalugaScope;
use App\Domain\Life\Scope\TripOfAdminScope;
use App\Domain\Life\Scope\TripVisibleScope;
use App\User;
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
            ->when($this->includeOnlyVisibleTrips(), new TripVisibleScope)
            ->orderBy('date_start')
            ->get();
    }

    #[\Override]
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
