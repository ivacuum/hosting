<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RadicalCollection extends ResourceCollection
{
    /**
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection
                ->map(fn ($item) => $item->toArray($request))
                ->when($this->shouldGroupByLevel($request), fn ($collection) => $collection->groupBy('level'))
        ];
    }

    protected function isSearching($request): bool
    {
        return $request->method() === 'POST';
    }

    protected function shouldGroupByLevel($request): bool
    {
        return !$this->isSearching($request) && !$request->input('kanji_id');
    }
}
