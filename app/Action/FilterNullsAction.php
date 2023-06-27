<?php

namespace App\Action;

class FilterNullsAction
{
    public function execute(array $data): array
    {
        foreach ($data as &$value) {
            if ($value instanceof \JsonSerializable) {
                $value = $value->jsonSerialize();
            }

            if (is_array($value)) {
                $value = $this->execute($value);
            }
        }

        return array_filter($data, fn ($value) => $value !== null);
    }
}
