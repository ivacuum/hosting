<?php

namespace App\Caster;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\VarDumper\Caster\Caster;
use Symfony\Component\VarDumper\Cloner\Stub;

class EloquentModelCaster
{
    public static function prune(Model $object, array $a, Stub $stub, bool $isNested): array
    {
        unset(
            $a[Caster::PREFIX_PROTECTED . 'connection'],
            $a[Caster::PREFIX_PROTECTED . 'table'],
            $a[Caster::PREFIX_PROTECTED . 'primaryKey'],
            $a[Caster::PREFIX_PROTECTED . 'keyType'],
            $a[Caster::PREFIX_PROTECTED . 'with'],
            $a[Caster::PREFIX_PROTECTED . 'withCount'],
            $a[Caster::PREFIX_PROTECTED . 'perPage'],
            $a[Caster::PREFIX_PROTECTED . 'escapeWhenCastingToString'],
            $a[Caster::PREFIX_PROTECTED . 'original'],
            $a[Caster::PREFIX_PROTECTED . 'changes'],
            $a[Caster::PREFIX_PROTECTED . 'casts'],
            $a[Caster::PREFIX_PROTECTED . 'classCastCache'],
            $a[Caster::PREFIX_PROTECTED . 'attributeCastCache'],
            $a[Caster::PREFIX_PROTECTED . 'dateFormat'],
            $a[Caster::PREFIX_PROTECTED . 'appends'],
            $a[Caster::PREFIX_PROTECTED . 'dispatchesEvents'],
            $a[Caster::PREFIX_PROTECTED . 'observables'],
            $a[Caster::PREFIX_PROTECTED . 'touches'],
            $a[Caster::PREFIX_PROTECTED . 'hidden'],
            $a[Caster::PREFIX_PROTECTED . 'visible'],
            $a[Caster::PREFIX_PROTECTED . 'fillable'],
            $a[Caster::PREFIX_PROTECTED . 'guarded'],
            $a[Caster::PREFIX_PROTECTED . 'rememberTokenName'],
            $a[Caster::PREFIX_PROTECTED . 'accessToken'],
            $a[Caster::PREFIX_PROTECTED . 'oldAttributes'],
            $a[Caster::PREFIX_PROTECTED . 'foreignKey'],
            $a[Caster::PREFIX_PROTECTED . 'relatedKey'],
            $a['incrementing'],
            $a['timestamps'],
            $a['preventsLazyLoading'],
            $a['exists'],
            $a['wasRecentlyCreated'],
            $a['usesUniqueIds'],
            $a['enableLoggingModelsEvents'],
            $a['pivotParent'],
        );

        return $a;
    }
}
