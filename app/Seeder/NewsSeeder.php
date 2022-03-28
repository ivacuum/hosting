<?php namespace App\Seeder;

use App\Factory\NewsFactory;
use App\Factory\UserFactory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    private const COUNT = 15;

    public function run()
    {
        $author = UserFactory::new()
            ->withEmail('news@example.com')
            ->withLogin('news')
            ->create();

        $newsFactory = NewsFactory::new()
            ->withUserId($author->id);

        $newsFactory
            ->withTitle('Markdown post')
            ->withMarkdown(<<<MARKDOWN
# Heading 1

**Bold**. *Italic*. [Link](https://example.com). \*Escape\*.

Documentation: https://example.com

## Heading 2

> Quote

Some `code`.

Multiline code:
```php
return [
    'flag' => true,
];
```

### Heading 3 ✍️

List:
- First
- Second
- Third
- Fourth
    - Second Level
MARKDOWN
            )
            ->create();

        for ($i = 0; $i < self::COUNT; $i++) {
            $newsFactory->create();
        }

        $newsFactory
            ->english()
            ->withTitle('English post')
            ->create();

        $newsFactory
            ->hidden()
            ->withTitle('Hidden post')
            ->create();
    }
}
