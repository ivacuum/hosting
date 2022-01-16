<?php namespace App\Http\Controllers\Acp;

use App\Domain\TripStatus;
use App\Trip;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\UsesLivewire;

class Trips extends AbstractController implements UsesLivewire
{
    protected $sortKey = 'date_start';
    protected $sortableKeys = ['date_start', 'views', 'comments_count', 'photos_count'];
    protected $showWithCount = ['comments', 'photos'];

    public function index()
    {
        $q = request('q');
        $status = request('status');
        $cityId = request('city_id');
        $userId = request('user_id');
        $countryId = request('country_id');

        $models = Trip::with('user')
            ->withCount('comments', 'photos')
            ->when($cityId, fn (Builder $query) => $query->where('city_id', $cityId))
            ->when($countryId, fn (Builder $query) => $query->whereRelation('city.country', 'country_id', $countryId))
            ->when($userId, fn (Builder $query) => $query->where('user_id', $userId))
            ->unless(null === $status, fn (Builder $query) => $query->where('status', TripStatus::from($status)))
            ->when($q,
                fn (Builder $query) => $query->where('id', $q)
                    ->orWhere(Trip::titleField(), 'LIKE', "%{$q}%")
                    ->orWhere('slug', 'LIKE', "%{$q}%"))
            ->orderBy($this->getSortKey(), $this->getSortDir())
            ->paginate(50);

        return view($this->view, ['models' => $models]);
    }
}
