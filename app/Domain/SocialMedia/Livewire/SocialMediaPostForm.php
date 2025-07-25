<?php

namespace App\Domain\SocialMedia\Livewire;

use App\Domain\SocialMedia\Action\CalculateNextPostDateAction;
use App\Domain\SocialMedia\Models\SocialMediaPost;
use App\Domain\SocialMedia\SocialMediaPostStatus;
use App\Livewire\WithGoto;
use App\Photo;
use App\Scope\PhotoPublishedScope;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;

class SocialMediaPostForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    #[Locked]
    public int|null $id = null;

    public string|null $titleEn = '';
    public string|null $titleRu = '';

    public Photo|null $photo = null;
    public string|null $caption = '';
    public CarbonImmutable|string|null $publishedAt = null;
    public SocialMediaPostStatus|null $status = SocialMediaPostStatus::Queued;

    public function mount(CalculateNextPostDateAction $calculateNextPostDate)
    {
        if ($this->id) {
            $post = SocialMediaPost::query()->findOrFail($this->id);

            $this->photo = $post->photo;
            $this->caption = $post->caption;
            $this->publishedAt = $post->published_at->toDateTimeLocalString();
        } else {
            $this->photo = Photo::query()
                ->whereBelongsTo(auth()->user())
                ->tap(new PhotoPublishedScope)
                ->inRandomOrder()
                ->firstOrFail();

            $this->photo->load('rel');
            $this->photo->rel->loadCityAndCountry();

            $this->caption = "{$this->photo->rel->city->hashtags} {$this->photo->rel->city->country->hashtags}";
            $this->publishedAt = $calculateNextPostDate
                ->execute(request()->user())
                ->toDateTimeLocalString();
        }
    }

    public function submit()
    {
        $this->authorize('create', SocialMediaPost::class);
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/social-media-posts'));
    }

    protected function rules()
    {
        // $tag = SocialMediaPost::query()->find($this->id);

        return [
            'caption' => [
                'required',
                // Rule::unique(SocialMediaPost::class, 'title_ru')->ignore($tag),
            ],
            'publishedAt' => [
                'required',
                Rule::unique(SocialMediaPost::class, 'published_at')->ignore($this->id),
            ],
        ];
    }

    private function store()
    {
        $post = $this->id
            ? SocialMediaPost::query()->findOrFail($this->id)
            : new SocialMediaPost;

        if (!$this->id) {
            $post->user_id = request()->user()->id;
            $post->photo_id = $this->photo->id;
        }

        $post->status = $this->status;
        $post->caption = $this->caption;
        $post->published_at = $this->publishedAt;
        $post->save();
    }
}
