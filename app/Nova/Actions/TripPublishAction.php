<?php namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields;

class TripPublishAction extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Publish';
    public $withoutConfirmation = true;

    public function handle(Fields\ActionFields $fields, Collection $models)
    {
        /** @var \App\Trip $model */
        foreach ($models as $model) {
            $model->status = $model::STATUS_PUBLISHED;
            $model->save();
        }

        return Action::message('OK');
    }
}
