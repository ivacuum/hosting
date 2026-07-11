<?php

namespace App\Action\Acp;

use App\Domain\ModelAccessibleRelation;
use App\Utilities\NamingHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class GetModelAccessibleRelationsAction
{
    public function __construct(private GenerateModelRelationLinkAction $generateModelRelationLink) {}

    /** @return Collection|ModelAccessibleRelation[] */
    public function execute(Model $model, array $showWithCount = []): Collection
    {
        if (count($showWithCount) < 1) {
            return collect();
        }

        $me = \Auth::user();
        $relatedByField = [];

        foreach ($showWithCount as $field) {
            $related = $model->{$field}()->getRelated();

            if (!$me->can('viewAny', $related)) {
                continue;
            }

            $relatedByField[$field] = $related;
        }

        if (count($relatedByField) < 1) {
            return collect();
        }

        $model->loadCount(array_keys($relatedByField));

        $result = [];

        foreach ($relatedByField as $field => $related) {
            $count = $model->{str($field)->snake() . '_count'};

            if ($count < 1) {
                continue;
            }

            $result[] = new ModelAccessibleRelation(
                $this->generateModelRelationLink->execute($model, $related),
                $count,
                NamingHelper::transField($related),
            );
        }

        return collect($result);
    }
}
