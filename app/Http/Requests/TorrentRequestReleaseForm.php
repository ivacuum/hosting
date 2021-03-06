<?php namespace App\Http\Requests;

class TorrentRequestReleaseForm extends AbstractForm
{
    public function authorize(): bool
    {
        return true;
    }

    public function comment(): ?string
    {
        return $this->input('comment');
    }

    public function rules(): array
    {
        return [
            'query' => 'required|string',
            'comment' => 'string',
        ];
    }

    public function q(): string
    {
        return $this->input('query');
    }
}
