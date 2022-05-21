<?php namespace App\Http\Livewire;

use App\Action\FindUserByEmailOrCreateAction;
use App\Domain\IssueStatus;
use App\Issue;
use App\RateLimit\IssueRateLimiter;
use App\Rules\Email;
use Illuminate\Validation\Rule;
use Livewire\Component;

class FeedbackForm extends Component
{
    public bool $hideName = false;
    public bool $hideTitle = false;
    public string $name = '';
    public string $text = '';
    public string $email = '';
    public string $title = '';

    public function mount()
    {
        $user = \Auth::user();

        if ($user && $this->name === '') {
            $this->name = $user->login ?? '';
        }

        if ($user && $this->email === '') {
            $this->email = $user->email;
        }
    }

    public function rules()
    {
        return [
            'name' => Rule::when(!$this->hideName, 'required'),
            'text' => ['required', 'string', 'max:1000'],
            'email' => Email::rules(),
            'title' => Rule::when(!$this->hideTitle, 'required'),
        ];
    }

    public function submit(FindUserByEmailOrCreateAction $findUserByEmailOrCreate, IssueRateLimiter $limiter)
    {
        $this->validate();

        $user = auth()->user();
        $isGuest = auth()->guest();

        if ($isGuest) {
            $user = $findUserByEmailOrCreate->execute(
                $this->email,
                new \App\Events\Stats\UserRegisteredAutoWhenIssueAdded,
                new \App\Events\Stats\UserFoundByEmailWhenIssueAdded
            );
        }

        if ($limiter->flooded($user->id)) {
            $this->addError('text', __('limits.flood_control'));

            return;
        } elseif ($limiter->tooManyAttempts($user->id)) {
            $this->addError('text', __('limits.issue'));

            return;
        }

        $issue = new Issue;
        $issue->name = $this->name;
        $issue->page = $this->pathFromUrl();
        $issue->text = $this->text;
        $issue->email = $this->email;
        $issue->title = $this->title;
        $issue->status = IssueStatus::Open;
        $issue->user_id = $user->id;
        $issue->save();

        $this->reset('text');

        session()->flash('message', __('Ваше сообщение принято. Мы постараемся отреагировать на него как можно скорее.'));
    }

    private function pathFromUrl(): string
    {
        $locale = request()->server->get('LARAVEL_LOCALE') ?? '';
        $parsed = parse_url(session()->previousUrl());

        $path = $parsed['path'] ?? '';
        $query = isset($parsed['query']) ? "?{$parsed['query']}" : '';
        $localeUri = $locale ? "/{$locale}" : '';

        return $localeUri . $path . $query;
    }
}
