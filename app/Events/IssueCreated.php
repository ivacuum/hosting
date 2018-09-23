<?php namespace App\Events;

use App\Issue as Model;
use Illuminate\Queue\SerializesModels;

/**
 * Получена обратная связь от посетителя
 *
 * @property \App\Issue $model
 */
class IssueCreated extends Event
{
    use SerializesModels;

    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
