<?php namespace App\Http\Controllers;

use App\Exceptions\IssueLimitExceededException;
use App\Http\Requests\IssueStore;
use App\Issue;
use App\Limits\IssuesTodayLimit;
use App\User;
use Ivacuum\Generic\Exceptions\FloodException;

class Issues extends Controller
{
    public function create()
    {
        return view($this->view);
    }

    public function store(IssuesTodayLimit $limits, IssueStore $request)
    {
        if (!$request->expectsJson()) {
            return redirect(path('Home@index'));
        }

        $name = $request->input('name');
        $text = $request->input('text');
        $email = $request->input('email');
        $title = $request->input('title');

        /** @var User $user */
        $user = $request->user();
        $isGuest = null === $user;

        if ($isGuest) {
            $user = (new User)->findByEmailOrCreate([
                'email' => $email,
                'status' => User::STATUS_INACTIVE,
            ]);

            if ($user->wasRecentlyCreated) {
                event(new \App\Events\Stats\UserRegisteredAutoWhenIssueAdded);
            } else {
                event(new \App\Events\Stats\UserFoundByEmailWhenIssueAdded);
            }
        }

        if ($limits->flood($user->id)) {
            throw new FloodException;
        } elseif ($limits->ipExceeded() || $limits->userExceeded($user->id)) {
            throw new IssueLimitExceededException;
        }

        Issue::create([
            'name' => $name,
            'page' => $this->pathFromUrl($request->session()->previousUrl(), $request->server->get('LARAVEL_LOCALE') ?? ''),
            'text' => $text,
            'email' => $email,
            'title' => $title,
            'status' => Issue::STATUS_OPEN,
            'user_id' => $user->id,
        ]);

        return response('', 201);
    }

    protected function pathFromUrl(string $url, string $locale): string
    {
        $parsed = parse_url($url);

        $path = $parsed['path'] ?? '';
        $query = isset($parsed['query']) ? "?{$parsed['query']}" : '';
        $localeUri = $locale ? "/{$locale}" : '';

        return $localeUri.$path.$query;
    }
}
