<?php namespace App\Http\Controllers;

use App\Exceptions\IssueLimitExceededException;
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

    public function store(IssuesTodayLimit $limits)
    {
        if (!request()->ajax()) {
            return redirect(path('Home@index'));
        }

        $name = request('name');
        $text = e(request('text'));
        $email = request('email');
        $title = request('title');

        /* @var User $user */
        $user = request()->user();
        $is_guest = null === $user;

        request()->validate([
            'name' => request()->ajax() ? '' : 'required',
            'text' => 'required|max:1000',
            'email' => 'required|email|max:125',
            'title' => request()->ajax() ? '' : 'required',
        ]);

        if ($is_guest) {
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
            'page' => $this->pathFromUrl(session()->previousUrl()),
            'text' => $text,
            'email' => $email,
            'title' => $title,
            'status' => Issue::STATUS_OPEN,
            'user_id' => $user->id,
        ]);

        return response('', 201);
    }

    protected function pathFromUrl(string $url): string
    {
        $parsed = parse_url($url);

        $path = $parsed['path'] ?? '';
        $query = isset($parsed['query']) ? "?{$parsed['query']}" : '';
        $locale = request()->server->get('LARAVEL_LOCALE');
        $locale_uri = $locale ? "/{$locale}" : '';

        return $locale_uri.$path.$query;
    }
}
