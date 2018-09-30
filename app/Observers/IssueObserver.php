<?php namespace App\Observers;

use App\Events\IssueCreated;
use App\Events\Stats;
use App\Issue as Model;

class IssueObserver
{
    public function created(Model $model)
    {
        event(new IssueCreated($model));
        event(new Stats\IssueAdded);
    }
}
