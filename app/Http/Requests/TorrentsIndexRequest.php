<?php namespace App\Http\Requests;

class TorrentsIndexRequest extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function categoryId(): ?int
    {
        return $this->input('category_id');
    }

    public function isFulltextSearch(): bool
    {
        return $this->input('fulltext', false);
    }

    public function searchQuery()
    {
        $q = $this->input('q');

        return mb_strlen($q) > 1
            ? $q
            : null;
    }

    public function rules(): array
    {
        return [];
    }
}
