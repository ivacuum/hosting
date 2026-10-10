<?php

namespace App\Http\Requests;

use App\Http\Controllers\NewsController;
use App\News;
use Illuminate\Foundation\Http\FormRequest;

class NewsShowForm extends FormRequest
{
    public News|null $news = null;

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

        return path_locale([NewsController::class, 'show'], $this->news->id, false, $this->news->locale->value);
    }

    public function rules(): array
    {
        return [];
    }

    public function shouldRedirectToIndex(): bool
    {
        return $this->news === null;
    }

    #[\Override]
    protected function passedValidation()
    {
        $this->news = News::query()->find($this->route('id'));
    }
}
