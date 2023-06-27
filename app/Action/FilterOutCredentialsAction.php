<?php

namespace App\Action;

use App\Domain\ExternalService;
use App\ExternalHttpRequest;

class FilterOutCredentialsAction
{
    public function __construct(private GetAllCredentialsAction $getAllCredentials)
    {
    }

    public function execute(ExternalHttpRequest $model)
    {
        $credentials = $this->getAllCredentials->execute();

        $keys = $credentials->keys()->all();
        $values = $credentials->values()->all();

        $model->path = str_replace($values, $keys, $model->path);
        $model->query = str_replace($values, $keys, $model->query);

        if (!empty($model->request_headers['Authorization'][0])) {
            $model->request_headers['Authorization'][0] = str_replace($values, $keys, $model->request_headers['Authorization'][0]);
        }

        match ($model->service_name) {
            ExternalService::Yandex => $this->yandex($model),
            default => null,
        };
    }

    private function yandex(ExternalHttpRequest $model)
    {
        if (!empty($model->request_headers['PddToken'][0])) {
            $model->request_headers['PddToken'][0] = 'XXX';
        }
    }
}
