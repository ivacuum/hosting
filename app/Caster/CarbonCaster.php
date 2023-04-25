<?php

namespace App\Caster;

use Carbon\CarbonInterface;
use Symfony\Component\VarDumper\Caster\Caster;
use Symfony\Component\VarDumper\Cloner\Stub;

class CarbonCaster
{
    public static function prune(CarbonInterface $object, array $a, Stub $stub, bool $isNested): array
    {
        foreach (array_keys($a) as $key) {
            if (str_starts_with($key, Caster::PREFIX_PROTECTED)) {
                unset($a[$key]);
                $stub->cut++;
            }
        }

        return $a;
    }
}
