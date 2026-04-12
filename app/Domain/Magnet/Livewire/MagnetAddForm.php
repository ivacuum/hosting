<?php

namespace App\Domain\Magnet\Livewire;

use App\Domain\Config;
use App\Domain\Magnet\MagnetStatus;
use App\Domain\Magnet\Models\Magnet;
use App\Domain\Magnet\Notification\AnonymousMagnetNotification;
use App\Domain\Magnet\RateLimit\MagnetRateLimiter;
use App\Domain\Magnet\Rule\MagnetCategoryId;
use App\Domain\Rto\Rto;
use App\Domain\Rto\RtoMagnetNotFoundException;
use App\Domain\Rto\RtoTopicDuplicateException;
use App\Domain\Rto\RtoTopicNotFoundException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class MagnetAddForm extends Component
{
    public int $size = 0;
    public int $topicId = 0;
    public int $categoryId = 0;
    public string $error = '';
    public string $input = '';
    public string $title = '';

    public function render()
    {
        return view('livewire.magnet-add-form');
    }

    public function submit(Rto $rto, MagnetRateLimiter $limiter)
    {
        $this->validate();

        if ($this->topicId <= 0) {
            throw ValidationException::withMessages([
                'input' => 'Ввод не распознан, попробуйте другую ссылку или хэш',
            ]);
        }

        try {
            $data = $rto->torrentData($this->topicId);
        } catch (\Throwable $e) {
            $this->addError('input', 'Возникли сложности с подключением к рутрекеру. Пожалуйста, повторите попытку');

            // Failed to connect() to host or proxy.
            if (str_starts_with($e->getMessage(), 'cURL error 7:')) {
                return null;
            }

            // Connection reset by peer
            if (str_starts_with($e->getMessage(), 'cURL error 35:')) {
                return null;
            }

            report($e);

            return null;
        }

        $userId = auth()->id();

        if ($limiter->tooManyAttempts()) {
            throw ValidationException::withMessages([
                'input' => __('Исчерпан лимит добавления раздач на сегодня. Повторите попытку через 24 часа'),
            ]);
        }

        $magnet = new Magnet;
        $magnet->html = $data->body;
        $magnet->size = $data->size;
        $magnet->title = $data->title;
        $magnet->clicks = 0;
        $magnet->rto_id = $data->id;
        $magnet->status = MagnetStatus::Published;
        $magnet->user_id = $userId ?? Config::MagnetAnonymousReleaser->get();
        $magnet->info_hash = $data->infoHash;
        $magnet->announcer = $data->announcer;
        $magnet->category_id = $this->categoryId;
        $magnet->registered_at = now();
        $magnet->related_query = '';

        try {
            $magnet->save();
        } catch (UniqueConstraintViolationException) {
            throw ValidationException::withMessages([
                'input' => 'Данная раздача уже присутствует на сайте. Вероятно, кто-то добавил ее быстрее вас.',
            ]);
        }

        if ($magnet->isAnonymous()) {
            event(new \App\Events\Stats\TorrentAddedAnonymously);

            $magnet->notify(new AnonymousMagnetNotification($magnet));
        }

        return redirect($magnet->www());
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
                throw ValidationException::withMessages([
                    'input' => 'Ввод не распознан, попробуйте другую ссылку или хэш',
                ]);
            }

            $topicData = $rto->topicDataById($topicId);

            $magnet = Magnet::query()->firstWhere('rto_id', $topicId);

            if ($magnet) {
                event(new \App\Events\Stats\TorrentDuplicateFound);

                throw ValidationException::withMessages([
                    'input' => 'Данная раздача уже присутствует на сайте. Попробуйте добавить другую.',
                ]);
            }
        } catch (\Throwable $e) {
            $this->resetTopicInfo();

            if ($e instanceof RtoMagnetNotFoundException) {
                throw ValidationException::withMessages([
                    'input' => 'Магнет-ссылка не найдена в раздаче, попробуйте другую ссылку',
                ]);
            } elseif ($e instanceof RtoTopicDuplicateException) {
                throw ValidationException::withMessages([
                    'input' => 'Раздача закрыта как повторная, попробуйте другую ссылку',
                ]);
            } elseif ($e instanceof RtoTopicNotFoundException) {
                throw ValidationException::withMessages([
                    'input' => 'Раздача не найдена, попробуйте другую ссылку',
                ]);
            }

            throw ValidationException::withMessages([
                'input' => 'Ввод не распознан, попробуйте другую ссылку или хэш',
            ]);
        }

        $this->size = $topicData->size;
        $this->title = $topicData->title;
        $this->topicId = $topicData->id;
    }

    protected function rules()
    {
        return [
            'input' => 'required',
            'categoryId' => MagnetCategoryId::rules(),
        ];
    }

    private function resetTopicInfo(): void
    {
        $this->size = 0;
        $this->title = '';
        $this->topicId = 0;
    }
}
