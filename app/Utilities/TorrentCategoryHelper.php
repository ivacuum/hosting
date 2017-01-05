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
                'title' => 'Зарубежное кино',
                'parent' => 1,
            ],
            3 => [
                'title' => 'Отечественное кино',
                'parent' => 1,
            ],
            4 => [
                'title' => 'Зарубежные сериалы',
                'parent' => 1,
            ],
            5 => [
                'title' => 'Русские сериалы',
                'parent' => 1,
            ],
            6 => [
                'title' => '3D',
                'parent' => 1,
            ],
            7 => [
                'title' => 'Мультфильмы',
                'parent' => 1,
            ],
            8 => [
                'title' => 'Мультсериалы',
                'parent' => 1,
            ],
            9 => [
                'title' => 'Аниме',
                'parent' => 1,
            ],

        //
        10 => [
            'title' => 'Документалистика, юмор и спорт',
            'parent' => 0,
        ],
            11 => [
                'title' => 'Документальные фильмы и телепередачи',
                'parent' => 10,
            ],
            12 => [
                'title' => 'Развлекательные телепередачи и шоу, приколы и юмор',
                'parent' => 10,
            ],
            13 => [
                'title' => 'Спортивные фильмы и передачи',
                'parent' => 10,
            ],

        //
        14 => [
            'title' => 'Музыка',
            'parent' => 0,
        ],
            15 => [
                'title' => 'Зарубежный рок',
                'parent' => 14,
            ],
            16 => [
                'title' => 'Отечественный рок',
                'parent' => 14,
            ],
            17 => [
                'title' => 'Джаз и блюз',
                'parent' => 14,
            ],
            18 => [
                'title' => 'Поп музыка, Eurodance, Disco',
                'parent' => 14,
            ],
            19 => [
                'title' => "Рэп, Хип-Хоп, R'n'B",
                'parent' => 14,
            ],
            20 => [
                'title' => 'Электронная музыка',
                'parent' => 14,
            ],
            21 => [
                'title' => 'Классическая музыка',
                'parent' => 14,
            ],
            22 => [
                'title' => 'Шансон, Авторская и Военная песня',
                'parent' => 14,
            ],
            23 => [
                'title' => 'Саундтреки и Караоке',
                'parent' => 14,
            ],
            24 => [
                'title' => 'Музыка других жанров',
                'parent' => 14,
            ],

        //
        25 => [
            'title' => 'Игры для Windows',
            'parent' => 0,
        ],
            26 => [
                'title' => 'Action',
                'parent' => 25,
            ],
            27 => [
                'title' => 'RPG',
                'parent' => 25,
            ],
            28 => [
                'title' => 'Аркады',
                'parent' => 25,
            ],
            29 => [
                'title' => 'Приключения и квесты',
                'parent' => 25,
            ],
            30 => [
                'title' => 'Симуляторы',
                'parent' => 25,
            ],
            31 => [
                'title' => 'Стратегии',
                'parent' => 25,
            ],
            32 => [
                'title' => 'Онлайн игры',
                'parent' => 25,
            ],
            33 => [
                'title' => 'Старые игры',
                'parent' => 25,
            ],
            34 => [
                'title' => 'Другие игры',
                'parent' => 25,
            ],

        //
        35 => [
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
            return $category['title'];
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
