<?php namespace App\Http\Requests;

use App\News;
use Illuminate\Foundation\Http\FormRequest;

class NewsShowForm extends FormRequest
{
    public ?News $news;

    public function authorize(): bool
    {
        return true;
    }

    public function ensureNewsIsPublished()
    {
        abort_unless($this->news->status->isPublished(), 404);
    }

    public function redirectUrlToOriginLocale(): string
    {
        $locale = \App::getLocale();

        if ($locale === $this->news->locale->value) {
            return '';
        }

        return $this->news->locale->isRussian()
            ? $this->path()
            : "/{$this->news->locale->value}/{$this->path()}";
    }

    public function rules(): array
    {
        return [];
    }

    public function shouldRedirectToIndex(): bool
    {
        return $this->news === null;
    }

    protected function passedValidation()
    {
        $this->news = News::find($this->route('id'));
    }
}
