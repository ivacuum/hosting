<?php namespace App\Http\Controllers;

use App\Issue;
use App\User;

class Issues extends Controller
{
    public function create()
    {
        return view($this->view);
    }

    public function store()
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

        Issue::create([
            'name' => $name,
            'page' => $this->pathFromUrl(session()->previousUrl()),
            'text' => $text,
            'email' => $email,
            'title' => $title,
            'status' => Issue::STATUS_OPEN,
            'user_id' => $is_guest ? 0 : $user->id,
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
