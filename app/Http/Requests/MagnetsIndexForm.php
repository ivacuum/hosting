<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MagnetsIndexForm extends FormRequest
{
    public readonly bool $isFulltextSearch;
    public readonly int|null $categoryId;
    public readonly array|null $category;

    public readonly string|null $searchQuery;

    public function rules(): array
    {
        return [];
    }

    protected function passedValidation()
    {
        $this->searchQuery = mb_strlen($this->input('q', '')) > 1
            ? $this->input('q')
            : null;

        $this->categoryId = is_numeric($this->input('category_id'))
            ? $this->input('category_id')
            : null;

        $this->category = $this->categoryId
            ? \TorrentCategoryHelper::find($this->categoryId)
            : null;

        $this->isFulltextSearch = $this->input('fulltext', false);
    }
}
