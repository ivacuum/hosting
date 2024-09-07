<?php

namespace App\Livewire\Acp;

use App\Domain\NewsStatus;
use App\Livewire\WithGoto;
use App\News;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewsForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    #[Locked]
    public int|null $id = null;

    #[Validate('required')]
    public string|null $title = '';

    #[Validate('required')]
    public string|null $markdown = '';

    #[Validate('required')]
    public NewsStatus $status = NewsStatus::Published;

    public function mount()
    {
        if ($this->id) {
            $news = News::query()->findOrFail($this->id);

            $this->title = $news->title;
            $this->status = $news->status;
            $this->markdown = $news->markdown;
        }
    }

    public function submit()
    {
        $this->authorize('create', News::class);
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/news'));
    }

    private function store()
    {
        $news = $this->id
            ? News::query()->findOrFail($this->id)
            : new News;

        if (!$this->id) {
            $news->locale = \App::getLocale();
            $news->user_id = request()->user()->id;
        }

        $news->title = $this->title;
        $news->status = $this->status;
        $news->markdown = $this->markdown;
        $news->save();
    }
}
