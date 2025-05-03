<?php

namespace App\Action;

class GetResizeImageWhitelistAction
{
    public function execute(): array
    {
        return [
            'life.ivacuum.org',
        ];
    }
}
