<?php namespace App\Events;

use App\Issue;
use Illuminate\Queue\SerializesModels;

/**
 * Получена обратная связь от посетителя
 *
 * @property \App\Issue $model
 */
class IssueCreated extends Event
{
    use SerializesModels;

    public Issue $model;

    public function __construct(Issue $model)
    {
        $this->model = $model;
    }
}
