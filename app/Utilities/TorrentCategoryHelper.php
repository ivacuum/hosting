<?php

namespace App\Utilities;

use App\Domain\Magnet\MagnetCategory;

class TorrentCategoryHelper
{
    // При увеличении вложенности понадобится поменять проверку в методе canPost
    protected $categories = [
        1 => [
            'title' => 'Кинематограф',
            'parent' => 0,
        ],
        25 => [
            'title' => 'Игры для Windows',
            'parent' => 0,
        ],
    ];

    protected $tree;

    public function __construct()
    {
        $this->categories += collect(MagnetCategory::cases())
            ->mapWithKeys(static fn (MagnetCategory $category) => [
                $category->value => [
                    'icon' => $category->icon(),
                    'title' => $category->title(),
                    'parent' => $category->parentId(),
                ],
            ])
            ->all();

        ksort($this->categories);
    }

    public function breadcrumbs($id)
    {
        if (empty($this->tree)) {
            $this->initTree();
        }

        $category = $this->tree[$id];

        if ($category['parent'] === 0) {
            return [$category];
        }

        $parent = $this->categories[$category['parent']];

        return [$parent, $category];
    }

    public function canPost($id)
    {
        if (empty($this->tree)) {
            $this->initTree();
        }

        return empty($this->tree[$id]['children']);
    }

    public function canPostIds()
    {
        return array_keys(array_filter($this->categories, $this->canPost(...), ARRAY_FILTER_USE_KEY));
    }

    public function children($id)
    {
        if (empty($this->tree)) {
            $this->initTree();
        }

        return $this->tree[$id]['children'] ?? [];
    }

    public function exists($id)
    {
        return isset($this->categories[$id]);
    }

    public function find($id)
    {
        return $this->categories[$id] ?? null;
    }

    public function selfAndDescendantsIds($id)
    {
        $children = $this->children($id);

        if (empty($children)) {
            return [$id];
        }

        return array_keys($children);
    }

    public function tree($parentId = 0)
    {
        if (empty($this->tree)) {
            $this->initTree();
        }

        return collect(array_filter($this->tree, static fn ($value) => $value['parent'] === $parentId));
    }

    protected function initTree()
    {
        $this->tree = $this->categories;

        foreach ($this->tree as $key => &$value) {
            if (isset($this->tree[$value['parent']])) {
                $this->tree[$value['parent']]['children'][$key] = &$value;
            }

            unset($value);
        }
    }
}
