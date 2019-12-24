<?php namespace App\Nova\Actions;

use App\Domain\TorrentUpdater;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields;

class TorrentRefreshAction extends Action
{
    use InteractsWithQueue;
    use Queueable;

    public $name = 'Refresh';

    private $torrentUpdater;

    public function __construct(TorrentUpdater $torrentUpdater)
    {
        $this->torrentUpdater = $torrentUpdater;
    }

    public $withoutConfirmation = true;

    public function handle(Fields\ActionFields $fields, Collection $models)
    {
        /** @var \App\Torrent $model */
        foreach ($models as $model) {
            $this->torrentUpdater->update($model);
        }

        return Action::message('OK');
    }
}
