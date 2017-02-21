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
                'icon' => 'tv',
                'title' => 'Зарубежные сериалы',
                'parent' => 1,
            ],
            5 => [
                'icon' => 'tv',
                'title' => 'Русские сериалы',
                'parent' => 1,
            ],
            6 => [
                'icon' => 'film',
                'title' => '3D',
                'parent' => 1,
            ],
            7 => [
                'icon' => 'film',
                'title' => 'Мультфильмы',
                'parent' => 1,
            ],
            8 => [
                'icon' => 'tv',
                'title' => 'Мультсериалы',
                'parent' => 1,
            ],
            9 => [
                'icon' => 'film',
                'title' => 'Аниме',
                'parent' => 1,
            ],

        //
        10 => [
            'title' => 'Документалистика, юмор и спорт',
            'parent' => 0,
        ],
            11 => [
                'icon' => 'microphone',
                'title' => 'Документалки',
                'parent' => 10,
            ],
            12 => [
                'icon' => 'smile-o',
                'title' => 'Развлекательные шоу, юмор',
                'parent' => 10,
            ],
            13 => [
                'icon' => 'soccer-ball-o',
                'title' => 'Спорт',
                'parent' => 10,
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
        14 => [
            'title' => 'Музыка',
            'parent' => 0,
        ],
            15 => [
                'icon' => 'music',
                'title' => 'Зарубежный рок',
                'parent' => 14,
            ],
            16 => [
                'icon' => 'music',
                'title' => 'Отечественный рок',
                'parent' => 14,
            ],
            17 => [
                'icon' => 'music',
                'title' => 'Джаз и блюз',
                'parent' => 14,
            ],
            18 => [
                'icon' => 'music',
                'title' => 'Поп музыка, Eurodance, Disco',
                'parent' => 14,
            ],
            19 => [
                'icon' => 'music',
                'title' => "Рэп, Хип-Хоп, R'n'B",
                'parent' => 14,
            ],
            20 => [
                'icon' => 'music',
                'title' => 'Электронная музыка',
                'parent' => 14,
            ],
            21 => [
                'icon' => 'music',
                'title' => 'Классическая музыка',
                'parent' => 14,
            ],
            22 => [
                'icon' => 'music',
                'title' => 'Шансон, Авторская и Военная песня',
                'parent' => 14,
            ],
            23 => [
                'icon' => 'music',
                'title' => 'Саундтреки и Караоке',
                'parent' => 14,
            ],
            24 => [
                'icon' => 'music',
                'title' => 'Музыка других жанров',
                'parent' => 14,
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
        return array_keys(array_filter($this->categories, function ($id) {
            return $this->canPost($id);
        }, ARRAY_FILTER_USE_KEY));
    }

    public function children($id)
    {
        if (empty($this->tree)) {
            $this->initTree();
        }

        return isset($this->tree[$id]['children']) ? $this->tree[$id]['children'] : [];
    }

    public function exists($id)
    {
        return isset($this->categories[$id]);
    }

    public function find($id)
    {
        return isset($this->categories[$id]) ? $this->categories[$id] : null;
    }

    public function selfAndDescendantsIds($id)
    {
        $children = $this->children($id);

        if (empty($children)) {
            return [$id];
        }

        return array_keys($children);
    }

    public function tree($parent_id = 0)
    {
        if (empty($this->tree)) {
            $this->initTree();
        }

        return collect(array_filter($this->tree, function ($value) use ($parent_id) {
            return $value['parent'] === $parent_id;
        }));
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
