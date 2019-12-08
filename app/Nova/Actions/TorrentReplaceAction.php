<?php namespace App\Nova\Actions;

use App\Domain\TorrentUpdater;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields;

class TorrentReplaceAction extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Replace';

    private $torrentUpdater;

    public function __construct(TorrentUpdater $torrentUpdater)
    {
        $this->torrentUpdater = $torrentUpdater;
    }

    public function fields()
    {
        return [
            Fields\Number::make('RTO ID')->required(),
        ];
    }

    public function handle(Fields\ActionFields $fields, Collection $models)
    {
        /** @var \App\Torrent $model */
        foreach ($models as $model) {
            $model->rto_id = $fields->get('rto_id');

            $this->torrentUpdater->update($model);
        }

        return Action::message('OK');
    }
}
