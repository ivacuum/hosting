<?php namespace App\Http\Livewire;

use App\Domain\LivewireEvent;
use App\Issue;
use App\Magnet;
use App\News;
use App\Trip;
use Livewire\Component;

class Comments extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection|\App\Comment[] */
    public $comments;
    public Issue|Magnet|News|Trip $model;

    public function freshComments()
    {
        $this->comments = $this->model
            ->commentsPublished()
            ->with('user')
            ->orderBy('created_at')
            ->get();
    }

    public function mount()
    {
        $this->freshComments();
    }

    protected function getListeners()
    {
        return [
            LivewireEvent::RefreshComments->name => 'freshComments',
        ];
    }
}
