<?php namespace App\Http\Requests;

use App\News;

class NewsShowForm extends AbstractForm
{
    private $news;

    public function authorize(): bool
    {
        return true;
    }

    public function ensureNewsIsPublished()
    {
        abort_unless($this->news()->status->isPublished(), 404);
    }

    public function news(): ?News
    {
        if ($this->news === null) {
            $this->news = News::find($this->route('id'));
        }

        return $this->news;
    }

    public function redirectUrlToOriginLocale(): string
    {
        $news = $this->news();
        $locale = \App::getLocale();

        if ($locale === $news->locale) {
            return '';
        }

        return $news->isRussian()
            ? $this->path()
            : "/{$news->locale}/{$this->path()}";
    }

    public function rules(): array
    {
        return [];
    }

    public function shouldRedirectToIndex(): bool
    {
        return $this->news() === null;
    }
}
