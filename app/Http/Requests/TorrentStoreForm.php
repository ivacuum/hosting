<?php namespace App\Http\Requests;

use App\Rules\TorrentCategoryId;
use App\Services\Rto;

class TorrentStoreForm extends AbstractRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function categoryId(): int
    {
        return $this->input('category_id');
    }

    public function rules(): array
    {
        return [
            'input' => 'required',
            'category_id' => TorrentCategoryId::rules(),
        ];
    }

    public function topicId(Rto $rto): ?int
    {
        return $rto->findTopicId($this->input('input'));
    }
}
