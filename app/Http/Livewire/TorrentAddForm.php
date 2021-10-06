<?php namespace App\Http\Livewire;

use App\Domain\TorrentStatus;
use App\Rules\TorrentCategoryId;
use App\Services\Rto;
use App\Services\RtoMagnetNotFoundException;
use App\Services\RtoTopicDuplicateException;
use App\Services\RtoTopicNotFoundException;
use App\Torrent;
use Livewire\Component;

class TorrentAddForm extends Component
{
    public int $size = 0;
    public int $topicId = 0;
    public int $categoryId = 0;
    public string $error = '';
    public string $input = '';
    public string $title = '';

    public function rules()
    {
        return [
            'input' => 'required',
            'categoryId' => TorrentCategoryId::rules(),
        ];
    }

    public function submit()
    {
        $this->validate();

        if ($this->topicId <= 0) {
            $this->addError('input', 'Ввод не распознан, попробуйте другую ссылку или хэш');

            return null;
        }

        $rto = app()->make(Rto::class);

        try {
            $data = $rto->torrentData($this->topicId);
        } catch (\Throwable $e) {
            $this->addError('input', 'Возникли сложности с подключением к рутрекеру. Пожалуйста, повторите попытку');

            // Connection reset by peer
            if (str_starts_with($e->getMessage(), 'cURL error 35:')) {
                return null;
            }

            report($e);

            return null;
        }

        $userId = auth()->id();

        if ($userId === null) {
            event(new \App\Events\Stats\TorrentAddedAnonymously);
        }

        $torrent = new Torrent;
        $torrent->html = $data->body;
        $torrent->size = $data->size;
        $torrent->title = $data->title;
        $torrent->clicks = 0;
        $torrent->rto_id = $data->id;
        $torrent->status = TorrentStatus::PUBLISHED;
        $torrent->user_id = $userId ?? config('cfg.torrent_anonymous_releaser');
        $torrent->info_hash = $data->infoHash;
        $torrent->announcer = $data->announcer;
        $torrent->category_id = $this->categoryId;
        $torrent->registered_at = now();
        $torrent->related_query = '';
        $torrent->save();

        return redirect($torrent->www());
    }

    public function updatedInput()
    {
        if ($this->input === '') {
            $this->resetTopicInfo();
        }

        $this->validateOnly('input');

        try {
            $rto = app()->make(Rto::class);
            $topicId = $rto->findTopicId($this->input);

            if ($topicId === null) {
                $this->addError('input', 'Ввод не распознан, попробуйте другую ссылку или хэш');

                return;
            }

            $topicData = $rto->topicDataById($topicId);

            $torrent = Torrent::firstWhere('rto_id', $topicId);

            if ($torrent) {
                event(new \App\Events\Stats\TorrentDuplicateFound);

                $this->addError('input', 'Данная раздача уже присутствует на сайте. Попробуйте добавить другую.');

                return;
            }
        } catch (\Throwable $e) {
            $this->resetTopicInfo();

            $error = 'Ввод не распознан, попробуйте другую ссылку или хэш';

            if ($e instanceof RtoMagnetNotFoundException) {
                $error = 'Магнет-ссылка не найдена в раздаче, попробуйте другую ссылку';
            } elseif ($e instanceof RtoTopicDuplicateException) {
                $error = 'Раздача закрыта как повторная, попробуйте другую ссылку';
            } elseif ($e instanceof RtoTopicNotFoundException) {
                $error = 'Раздача не найдена, попробуйте другую ссылку';
            }

            $this->addError('input', $error);

            return;
        }

        $this->size = $topicData->size;
        $this->title = $topicData->title;
        $this->topicId = $topicData->id;
    }

    private function resetTopicInfo(): void
    {
        $this->size = 0;
        $this->title = '';
        $this->topicId = 0;
    }
}
