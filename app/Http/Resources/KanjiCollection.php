<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KanjiCollection extends ResourceCollection
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
        return !$this->isSearching($request) &&
            !$request->input('radical_id') &&
            !$request->input('similar_id') &&
            !$request->input('vocabulary_id');
    }
}
