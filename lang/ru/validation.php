<?php

return [
    'accepted' => 'Необходимо принять :attribute.',
    'active_url' => 'Поле :attribute содержит недействительный URL.',
    'after' => 'В поле :attribute должна быть дата после :date.',
    'after_or_equal' => 'В поле :attribute должна быть дата не ранее :date.',
    'alpha' => 'Поле :attribute может содержать лишь буквы.',
    'alpha_dash' => 'Поле :attribute может содержать лишь буквы, цифры, дефис и нижнее подчеркивание.',
    'alpha_num' => 'Поле :attribute может содержать лишь буквы и цифры.',
    'array' => 'Поле :attribute должно быть массивом.',
    'before' => 'В поле :attribute должна быть дата до :date.',
    'before_or_equal' => 'В поле :attribute должна быть дата не позднее :date.',
    'between' => [
        'numeric' => 'Поле :attribute должно быть между :min и :max.',
        'file' => 'Размер файла в поле :attribute должен быть между :min и :max КБ.',
        'string' => 'Количество символов в поле :attribute должно быть между :min и :max.',
        'array' => 'Количество элементов в поле :attribute должно быть между :min и :max.',
    ],
    'boolean' => 'Поле :attribute должно иметь значение да или нет.',
    'confirmed' => 'Поле :attribute не совпадает с подтверждением.',
    'date' => 'Поле :attribute не является датой.',
    'date_format' => 'Поле :attribute не соответствует формату :format.',
    'different' => 'Поля :attribute и :other должны отличаться.',
    'digits' => 'Длина цифрового поля :attribute должна быть :digits.',
    'digits_between' => 'Длина цифрового поля :attribute должна быть между :min и :max.',
    'dimensions' => 'Поле :attribute имеет недопустимые размеры изображения.',
    'distinct' => 'Поле :attribute содержит повторяющееся значение.',
    'email' => 'Значение поля :attribute не похоже на электронную почту',
    'exists' => 'Выбранное для поля :attribute значение некорректно.',
    'file' => 'Поле :attribute должно быть файлом.',
    'filled' => 'Поле :attribute обязательно для заполнения.',
    'gt' => [
        'numeric' => 'Поле :attribute должно быть больше :value.',
        'file' => 'Размер файла в поле :attribute должен быть больше :value КБ.',
        'string' => 'Количество символов в поле :attribute должно быть больше :value.',
        'array' => 'Количество элементов в поле :attribute должно быть больше :value.',
    ],
    'gte' => [
        'numeric' => 'Поле :attribute должно быть больше или равно :value.',
        'file' => 'Размер файла в поле :attribute должен быть больше или равен :value КБ.',
        'string' => 'Количество символов в поле :attribute должно быть больше или равно :value.',
        'array' => 'Количество элементов в поле :attribute должно быть больше или равно :value.',
    ],
    'image' => 'Поле :attribute должно быть изображением.',
    'in' => 'Выбранное для поля :attribute значение некорректно.',
    'in_array' => 'Поле :attribute не существует в :other.',
    'integer' => 'Поле :attribute должно быть целым числом.',
    'ip' => 'Поле :attribute должно быть действительным IP-адресом.',
    'ipv4' => 'Поле :attribute должно быть действительным IPv4-адресом.',
    'ipv6' => 'Поле :attribute должно быть действительным IPv6-адресом.',
    'json' => 'Поле :attribute должно быть JSON-строкой.',
    'lt' => [
        'numeric' => 'Поле :attribute должно быть меньше :value.',
        'file' => 'Размер файла в поле :attribute должен быть меньше :value КБ.',
        'string' => 'Количество символов в поле :attribute должно быть меньше :value.',
        'array' => 'Количество элементов в поле :attribute должно быть меньше :value.',
    ],
    'lte' => [
        'numeric' => 'Поле :attribute должно быть меньше или равно :value.',
        'file' => 'Размер файла в поле :attribute должен быть меньше или равен :value КБ.',
        'string' => 'Количество символов в поле :attribute должно быть меньше или равно :value.',
        'array' => 'Количество элементов в поле :attribute должно быть меньше или равно :value.',
    ],
    'max' => [
        'numeric' => 'Поле :attribute не должно быть более :max.',
        'file' => 'Размер файла в поле :attribute должен быть не более :max КБ.',
        'string' => 'Количество символов в поле :attribute не должно быть более :max.',
        'array' => 'Количество элементов в поле :attribute не должно быть более :max.',
    ],
    'mimes' => 'Поле :attribute должно быть файлом одного из следующих типов: :values.',
    'mimetypes' => 'Поле :attribute должно быть файлом одного из следующих типов: :values.',
    'min' => [
        'numeric' => 'Поле :attribute не должно быть менее :min.',
        'file' => 'Размер файла в поле :attribute должен быть не менее :min КБ.',
        'string' => 'Количество символов в поле :attribute должно быть не менее :min.',
        'array' => 'Количество элементов в поле :attribute должно быть не менее :min.',
    ],
    'not_in' => 'Выбранное значение для поля :attribute некорректно.',
    'not_regex' => 'Формат поля :attribute некорректен.',
    'numeric' => 'Поле :attribute должно быть числом.',
    'present' => 'Поле :attribute должно присутствовать.',
    'regex' => 'Формат поля :attribute некорректен.',
    'required' => 'Поле :attribute обязательно для заполнения.',
    'required_if' => 'Поле :attribute обязательно для заполнения, когда :other равно :value.',
    'required_unless' => 'Поле :attribute обязательно для заполнения, когда :other не равно :values.',
    'required_with' => 'Поле :attribute обязательно для заполнения, когда :values указано.',
    'required_with_all' => 'Поле :attribute обязательно для заполнения, когда :values указано.',
    'required_without' => 'Поле :attribute обязательно для заполнения, когда :values не указано.',
    'required_without_all' => 'Поле :attribute обязательно для заполнения, когда ни одно из :values не указано.',
    'same' => 'Значения полей :attribute и :other должны совпадать.',
    'size' => [
        'numeric' => 'Поле :attribute должно быть равным :size.',
        'file' => 'Размер файла в поле :attribute должен быть равным :size КБ.',
        'string' => 'Количество символов в поле :attribute должно быть равным :size.',
        'array' => 'Количество элементов в поле :attribute должно быть равным :size.',
    ],
    'string' => 'Поле :attribute должно быть строкой.',
    'timezone' => 'Поле :attribute должно быть действительным часовым поясом.',
    'unique' => 'Такое значение поля :attribute уже существует.',
    'uploaded' => 'Загрузка поля :attribute не удалась.',
    'url' => 'Формат поля :attribute некорректен.',

    'concurrency_control' => 'Кто-то обновил объект до сохранения ваших правок. Обновите страницу и повторите попытку.',
    // Вы можете: 1) отменить свои правки — обновить страницу или перейти на другую 2) объединить изменения — в соседней вкладке воспроизвести свои правки 3) перезаписать чужие правки — повторно сохранить изменения.

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'slug' => [
            'unique' => 'Этот адрес уже занят',
        ],
        'username' => [
            'unique' => 'Такой логин уже занят, выберите другой',
        ],
    ],

    'attributes' => [],
];
