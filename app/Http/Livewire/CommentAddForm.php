<?php

namespace App\Http\Livewire;

use App\Action\FindUserByEmailOrCreateAction;
use App\Comment;
use App\Domain\CommentStatus;
use App\Domain\LivewireEvent;
use App\Limits\CommentsTodayLimit;
use App\Magnet;
use App\News;
use App\Rules\Email;
use App\Trip;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CommentAddForm extends Component
{
    public string $text = '';
    public string $email = '';
    public Magnet|News|Trip $model;

    public function rules()
    {
        return [
            'text' => 'required|max:1000',
            'email' => Rule::when(auth()->guest(), Email::rules()),
        ];
    }

    public function submit(FindUserByEmailOrCreateAction $findUserByEmailOrCreate, CommentsTodayLimit $limits)
    {
        $this->validate();

        if (!$this->model->status->isPublished()) {
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

        if ($limits->flood($user->id)) {
            $this->addError('text', __('limits.flood_control'));

            return;
        } elseif ($limits->ipExceeded() || $limits->userExceeded($user->id)) {
            $this->addError('text', __('limits.comment'));

            return;
        }

        $comment = new Comment;
        $comment->html = e($this->text);
        $comment->status = $isGuest
            ? CommentStatus::Pending
            : CommentStatus::Published;
        $comment->user_id = $user->id;
        $comment->setRelation('user', $user);

        $this->model->comments()->save($comment);

        $this->reset('text');
        $this->emit(LivewireEvent::RefreshComments->name);

        if ($isGuest) {
            session()->flash('message', __('Комментарий ожидает активации. Мы отправили вам ссылку на электронную почту.'));
        }
    }
}
