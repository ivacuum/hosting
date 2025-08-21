<?php

namespace App\Livewire;

use App\Action\FindUserByEmailOrCreateAction;
use App\Comment;
use App\Domain\CommentStatus;
use App\Domain\Life\Models\Trip;
use App\Domain\LivewireEvent;
use App\Domain\Magnet\Models\Magnet;
use App\Issue;
use App\News;
use App\RateLimit\CommentRateLimiter;
use App\Rules\Email;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CommentAddForm extends Component
{
    public string $text = '';
    public string $email = '';
    public Issue|Magnet|News|Trip $model;

    public function submit(FindUserByEmailOrCreateAction $findUserByEmailOrCreate, CommentRateLimiter $limiter)
    {
        $this->validate();

        if (!$this->model->canBeCommented()) {
            $this->addError('text', 'Эту страницу нельзя прокомментировать.');

            return;
        }

        $user = auth()->user();
        $isGuest = auth()->guest();

        if ($isGuest) {
            $user = $findUserByEmailOrCreate->execute(
                $this->email,
                new \App\Events\Stats\UserRegisteredAutoWhenCommentAdded,
                new \App\Events\Stats\UserFoundByEmailWhenCommentAdded
            );
        }

        if ($limiter->flooded($user->id)) {
            $this->addError('text', __('limits.flood_control'));

            return;
        } elseif ($limiter->tooManyAttempts($user->id)) {
            $this->addError('text', __('limits.comment'));

            return;
        }

        $comment = new Comment;
        $comment->html = $this->escapeText();
        $comment->status = $isGuest
            ? CommentStatus::Pending
            : CommentStatus::Published;
        $comment->user_id = $user->id;
        $comment->setRelation('user', $user);

        $this->model->comments()->save($comment);

        $this->reset('text');
        $this->dispatch(LivewireEvent::RefreshComments->name);

        if ($isGuest) {
            session()->flash('message', __('Комментарий ожидает активации. Мы отправили вам ссылку на электронную почту.'));
        }
    }

    protected function rules()
    {
        return [
            'text' => 'required|max:1000',
            'email' => Rule::when(auth()->guest(), Email::rules()),
        ];
    }

    private function escapeText()
    {
        if ($this->model instanceof Issue) {
            return $this->text;
        }

        return e($this->text);
    }
}
