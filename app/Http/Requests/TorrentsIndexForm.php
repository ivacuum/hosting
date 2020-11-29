<?php namespace App\Http\Requests;

class TorrentsIndexForm extends AbstractForm
{
    public function authorize(): bool
    {
        return true;
    }

    public function category()
    {
        if (!$this->categoryId()) {
            return null;
        }

        return \TorrentCategoryHelper::find($this->categoryId());
    }

    public function categoryId(): ?int
    {
        $categoryId = $this->input('category_id');

        return is_numeric($categoryId)
            ? $categoryId
            : null;
    }

    public function isFulltextSearch(): bool
    {
        return $this->input('fulltext', false);
    }

    public function searchQuery(): ?string
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
