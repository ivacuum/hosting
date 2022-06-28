<?php namespace App\Action\Acp;

use App\Domain\ModelAccessibleRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Ivacuum\Generic\Utilities\NamingHelper;

class GetModelAccessibleRelationsAction
{
    public function __construct(private GenerateModelRelationLinkAction $generateModelRelationLink)
    {
    }

    /** @return Collection|ModelAccessibleRelation[] */
    public function execute(Model $model, array $showWithCount = []): Collection
    {
        if (count($showWithCount) < 1) {
            return collect();
        }

        $me = \Auth::user();
        $result = [];

        foreach ($showWithCount as $field) {
            $related = $model->{$field}()->getRelated();

            if (!$me->can('viewAny', $related)) {
                continue;
            }

            $model->loadCount($field);
            $countField = str($field)->snake() . '_count';
            $count = $model->{$countField};

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
