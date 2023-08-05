<?php

namespace App\Action;

class GetResizeImageWhitelistAction
{
    public function execute(): array
    {
        return [
            'https://life.ivacuum.ru/',
            'https://life.ivacuum.org/',
        ];
    }
}
