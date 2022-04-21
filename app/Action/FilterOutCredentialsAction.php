<?php namespace App\Action;

use App\Domain\ExternalService;
use App\ExternalHttpRequest;

class FilterOutCredentialsAction
{
    public function execute(ExternalHttpRequest $model)
    {
        match ($model->service_name) {
            ExternalService::Telegram => $this->telegram($model),
            ExternalService::Vk => $this->vk($model),
            ExternalService::Wanikani => $this->wanikani($model),
            ExternalService::Yandex => $this->yandex($model),
            default => null,
        };
    }

    private function telegram(ExternalHttpRequest $model)
    {
        $model->path = preg_replace('#^/bot\d+:.*/(.*)#', '/botXXX/$1', $model->path);
    }

    private function vk(ExternalHttpRequest $model)
    {
        $token = config('services.vk.access_token');

        $model->query = str_replace("access_token={$token}", 'access_token=XXX', $model->query);
    }

    private function wanikani(ExternalHttpRequest $model)
    {
        if (!empty($model->request_headers['Authorization'][0])) {
            $model->request_headers['Authorization'][0] = 'XXX';
        }
    }

    private function yandex(ExternalHttpRequest $model)
    {
        if (!empty($model->request_headers['PddToken'][0])) {
            $model->request_headers['PddToken'][0] = 'XXX';
        }
    }
}