<?php namespace App\Http\Resources\Acp;

use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin \App\Tag
 */
class Tag extends Resource
{
    public function toArray($request)
    {
        /** @var \App\User $me */
        $me = $request->user();
        $foreignKey = [$this->getForeignKey() => $this->id];

        return [
            'id' => $this->id,
            'title' => $this->title,
            'views' => $this->views,
            'breadcrumb' => $this->breadcrumb(),

            'edit_url' => $this->when(
                $me->can('edit', 'App\Tag'),
                path(['App\Http\Controllers\Acp\Tags', 'edit'], $this)
            ),
            'show_url' => $this->when(
                $me->can('show', 'App\Tag'),
                path(['App\Http\Controllers\Acp\Tags', 'show'], $this)
            ),
            'photos_url' => $this->when(
                $me->can('show', 'App\Photo'),
                path(['App\Http\Controllers\Acp\Photos', 'index'], $foreignKey)
            ),

            'photos_count' => (int) $this->photos_count,
        ];
    }
}
