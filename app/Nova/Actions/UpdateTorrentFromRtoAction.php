<?php

namespace App\Nova\Actions;

use App\Services\Rto;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields;

class UpdateTorrentFromRtoAction extends Action
{
    use InteractsWithQueue, Queueable;

    private $rto;

    public function __construct(Rto $rto)
    {
        $this->rto = $rto;
    }

    public $withoutConfirmation = true;

    public function handle(Fields\ActionFields $fields, Collection $models)
    {
        /** @var \App\Torrent $model */
        foreach ($models as $model) {
            if (!is_array($data = $this->rto->torrentData($model->rto_id))) {
                return Action::danger('Не удалось обновить информацию о раздаче');
            }

            $regTime = Carbon::createFromTimestamp($data['reg_time']);
            $registeredAt = $regTime->gt($model->registered_at) ? now() : $model->registered_at;

            $model->html = $data['body'];
            $model->size = $data['size'];
            $model->title = $data['title'];
            $model->info_hash = $data['info_hash'];
            $model->announcer = $data['announcer'];
            $model->registered_at = $registeredAt;
            $model->save();
        }

        return Action::message('Раздача обновлена');
    }
}
