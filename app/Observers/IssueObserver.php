<?php namespace App\Observers;

use App\Events\IssueCreated;
use App\Issue as Model;

class IssueObserver
{
    public function created(Model $model)
    {
        event(new IssueCreated($model));
        event(new \App\Events\Stats\IssueAdded);
    }
}
