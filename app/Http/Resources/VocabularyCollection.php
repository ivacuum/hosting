<?php namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VocabularyCollection extends ResourceCollection
{
    /**
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection
                ->map(function ($item) use ($request) {
                    return $item->toArray($request);
                })
                ->when($this->shouldGroupByLevel($request), function ($collection) {
                    return $collection->groupBy('level');
                })
        ];
    }

    protected function isSearching($request): bool
    {
        return $request->method() === 'POST';
    }

    protected function shouldGroupByLevel($request): bool
    {
        return !$this->isSearching($request) && !$request->input('kanji');
    }
}
