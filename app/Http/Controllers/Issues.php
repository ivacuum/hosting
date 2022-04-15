<?php namespace App\Http\Controllers;

use App\Action\FindUserByEmailOrCreateAction;
use App\Domain\IssueStatus;
use App\Exceptions\IssueLimitExceededException;
use App\Http\Requests\IssueStoreForm;
use App\Issue;
use App\Limits\IssuesTodayLimit;
use Ivacuum\Generic\Exceptions\FloodException;

class Issues extends Controller
{
    public function __invoke(
        IssuesTodayLimit $limits,
        IssueStoreForm $request,
        FindUserByEmailOrCreateAction $findUserByEmailOrCreate
    ) {
        $user = $request->user;
        $isGuest = $request->isGuest();

        if ($isGuest) {
            $user = $findUserByEmailOrCreate->execute($request->email);

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
        $issue->name = $request->name;
        $issue->page = $request->pathFromUrl();
        $issue->text = $request->text;
        $issue->email = $request->email;
        $issue->title = $request->title;
        $issue->status = IssueStatus::Open;
        $issue->user_id = $user->id;
        $issue->save();

        return response(status: 201);
    }
}
