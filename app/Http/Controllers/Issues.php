<?php namespace App\Http\Controllers;

use App\Exceptions\IssueLimitExceededException;
use App\Http\Requests\IssueStoreRequest;
use App\Issue;
use App\Limits\IssuesTodayLimit;
use App\User;
use Ivacuum\Generic\Exceptions\FloodException;

class Issues extends Controller
{
    public function __invoke(IssuesTodayLimit $limits, IssueStoreRequest $request)
    {
        $user = $request->userModel();
        $email = $request->email();
        $isGuest = $request->isGuest();

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

        $issue = new Issue;
        $issue->name = $request->name();
        $issue->page = $request->pathFromUrl();
        $issue->text = $request->text();
        $issue->email = $email;
        $issue->title = $request->title();
        $issue->status = Issue::STATUS_OPEN;
        $issue->user_id = $user->id;
        $issue->save();

        return response('', 201);
    }
}
