<?php namespace App\Utilities;

class TorrentCategoryHelper
{
    // При увеличении вложенности понадобится поменять проверку в методе canPost
    protected $categories = [
        1 => [
            'title' => 'Кинематограф', // Кинематограф
            'parent' => 0,
        ],
            2 => [
                'icon' => 'film',
                'title' => 'Зарубежное кино',
                'parent' => 1,
            ],
            3 => [
                'icon' => 'film',
                'title' => 'Отечественное кино',
                'parent' => 1,
            ],
            4 => [
                'icon' => 'collection-play',
                'title' => 'Зарубежные сериалы',
                'parent' => 1,
            ],
            5 => [
                'icon' => 'collection-play',
                'title' => 'Русские сериалы',
                'parent' => 1,
            ],
            7 => [
                'icon' => 'film',
                'title' => 'Мультфильмы',
                'parent' => 1,
            ],
            8 => [
                'icon' => 'collection-play',
                'title' => 'Мультсериалы',
                'parent' => 1,
            ],
            9 => [
                'icon' => 'film',
                'title' => 'Аниме',
                'parent' => 1,
            ],

        //
        25 => [
            'title' => 'Игры для Windows',
            'parent' => 0,
        ],
            26 => [
                'icon' => 'gamepad',
                'title' => 'Action',
                'parent' => 25,
            ],
            27 => [
                'icon' => 'gamepad',
                'title' => 'RPG',
                'parent' => 25,
            ],
            28 => [
                'icon' => 'gamepad',
                'title' => 'Аркады',
                'parent' => 25,
            ],
            29 => [
                'icon' => 'gamepad',
                'title' => 'Приключения и квесты',
                'parent' => 25,
            ],
            30 => [
                'icon' => 'gamepad',
                'title' => 'Симуляторы',
                'parent' => 25,
            ],
            31 => [
                'icon' => 'gamepad',
                'title' => 'Стратегии',
                'parent' => 25,
            ],
            32 => [
                'icon' => 'gamepad',
                'title' => 'Онлайн игры',
                'parent' => 25,
            ],
            33 => [
                'icon' => 'gamepad',
                'title' => 'Старые игры',
                'parent' => 25,
            ],
            34 => [
                'icon' => 'gamepad',
                'title' => 'Другие игры',
                'parent' => 25,
            ],

        //
        35 => [
            'icon' => 'file-text-o',
            'title' => 'Прочее',
            'parent' => 0,
        ]
    ];

    protected $tree;

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
        return array_keys(array_filter($this->categories, fn ($id) => $this->canPost($id), ARRAY_FILTER_USE_KEY));
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

    public function novaList()
    {
        return collect($this->categories)
            ->reject(fn ($item, $key) => !self::canPost($key))
            ->mapWithKeys(fn ($item, $key) => [
                $key => [
                    'label' => $item['title'],
                    'group' => $item['parent'],
                ],
            ]);
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

        return collect(array_filter($this->tree, fn ($value) => $value['parent'] === $parentId));
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
