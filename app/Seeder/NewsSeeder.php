<?php namespace App\Seeder;

use App\Factory\NewsFactory;
use App\Factory\UserFactory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
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

        $newsFactory
            ->withTitle('SpaceX')
            ->withMarkdown('Сегодня, 25 марта 2023 года, в ходе пресс-конференции компания SpaceX представила новый план миссии на Марс, который предполагает отправку первой группы колонистов на красную планету уже в 2026 году, с использованием ракеты Starship и поддержки на орбите спутника-заправщика.')
            ->create();

        $newsFactory
            ->withTitle('Туризм процветает')
            ->withMarkdown('Сообщается о том, что в ряде стран было заметно увеличение количества туристов после снятия ограничений на въезд, что говорит о том, что люди все еще жаждут путешествий и готовы покорять новые горизонты, а также встречать новых людей и культуры. Более того, сфера туризма начала активно адаптироваться к новым реалиям, предлагая туристам больше возможностей для безопасного и комфортного отдыха, что дает надежду на дальнейшее восстановление отрасли в ближайшее время.')
            ->create();

        $newsFactory
            ->withTitle('Засиделись дома')
            ->withMarkdown('Согласно недавнему исследованию, проведенному ведущим туристическим порталом, большинство людей, планирующих свой отпуск в ближайшие месяцы, выбирают для путешествий родной город или страну, что позволяет им не только экономить деньги, но и узнать много нового о своей культуре и истории, а также насладиться красотами родной природы и архитектуры, что является отличным поводом для отдыха и развития.')
            ->create();

        $newsFactory
            ->withTitle('Новый способ путешествовать без оставления дома')
            ->withMarkdown('Сегодня стало известно о запуске новой технологии виртуальных путешествий, которая позволит людям наслаждаться красотами мира, не выходя из дома. С помощью специальных устройств и программ можно будет погрузиться в самые экзотические места мира, посетить культурные мероприятия, увидеть легендарные достопримечательности и даже взаимодействовать с местными жителями. Эта новая технология позволит многим людям увидеть мир во всей его красе, не выходя из дома, что является великолепным способом путешествовать в наше время.')
            ->create();

        $newsFactory
            ->withTitle('Ощути свободу: возможности для путешествий внутри страны')
            ->withMarkdown('В последнее время все больше людей начинают замечать, что в их родной стране также есть множество интересных мест и достопримечательностей, которые еще не успели посетить. Многие любители путешествий начали исследовать свою страну более тщательно, и с каждым разом открывают для себя что-то новое и удивительное. Благодаря этому местные туристические компании и предприниматели начинают активно развивать внутренний туризм, создавая новые услуги и маршруты для путешественников. В итоге, все больше людей получают возможность насладиться красотами своей страны, открывая для себя новые грани туризма и ощущая настоящую свободу передвижения и открытий.')
            ->create();

        $newsFactory
            ->withTitle('Путешествия, которые восстанавливают здоровье')
            ->withMarkdown('Сегодня эксперты подтвердили, что путешествия могут не только радовать, но и положительно влиять на наше здоровье: общение с новыми людьми, знакомство с культурой других стран, отдых на природе, спортивные мероприятия - все это помогает уменьшить стресс, повышает иммунитет и улучшает настроение. Поэтому сейчас путешествия становятся не только приятным отдыхом, но и важным фактором поддержания нашего здоровья и благополучия.')
            ->create();

        $newsFactory
            ->withTitle('Новый формат туризма: теперь путешествуйте со знанием дела')
            ->withMarkdown('В последнее время становится все популярнее формат туризма, который включает в себя не только отдых и экскурсии, но и возможность участвовать в экологических проектах, помогать местному населению и знакомиться с культурой страны изнутри. Благодаря этому туристы не только получают новые впечатления и знания, но и вносят свой вклад в развитие местных сообществ и сохранение природы. Эта тенденция радует и дает возможность получить более глубокие и насыщенные впечатления от путешествий.')
            ->create();

        $newsFactory
            ->withTitle('Новый формат туризма в Африке: открытие путей в неизведанные места')
            ->withMarkdown('Африка всегда была знаменита своими уникальными ландшафтами и флорой, и теперь туристы смогут исследовать регионы, которые ранее были недоступны для туризма. К ним относятся, например, пустыни, заброшенные города, национальные парки и заповедники, а также множество красивых и нетронутых пляжей на побережье. Местные туроператоры и гиды предоставят возможность открыть для себя невероятную красоту дикой природы Африки, узнать много интересного о местной культуре и традициях, а также получить незабываемые впечатления от путешествий в уникальных местах.')
            ->create();

        $newsFactory
            ->withTitle('Путешествие в невероятную страну льдов: как открыть для себя Антарктиду')
            ->withMarkdown('Когда мы думаем о путешествиях, Антарктида обычно не первое место, которое приходит нам на ум. Но это несправедливо - эта загадочная и красивая земля обладает своим уникальным очарованием и несет в себе невероятный потенциал для путешественников. Сегодня, благодаря технологическому прогрессу, стало возможным отправиться в путешествие к этому континенту и увидеть своими глазами его огромные ледяные поля, а также обнаружить уникальную флору и фауну, которые выживают в условиях постоянной мерзлоты. В поисках приключений и новых впечатлений, многие путешественники уже отправляются в Антарктиду, чтобы насладиться этой невероятной красотой.')
            ->create();

        $newsFactory
            ->english()
            ->withTitle('Rediscovering the World: Travelers Reveal the Joy of Exploration')
            ->withMarkdown("As travel restrictions ease in many parts of the world, people are taking the opportunity to rediscover the joys of exploration. From backpacking trips in Southeast Asia to luxury cruises in the Mediterranean, travelers are venturing out to see the world like never before. For many, travel is not just about ticking off bucket list items, but about connecting with people and cultures, learning new things, and expanding horizons. The thrill of discovering new places and experiencing new adventures has never been more enticing. As travelers share their stories of adventure and inspiration, it's clear that the joy of exploration is alive and well, and ready to be rediscovered by anyone willing to take the leap.")
            ->create();

        $newsFactory
            ->hidden()
            ->withTitle('Hidden in the ocean')
            ->withMarkdown("Scientists have made a groundbreaking discovery of a microscopic ecosystem hidden from the human eye in the ocean. Using high-resolution microscopes and advanced imaging techniques, they have identified a vast array of previously unknown microorganisms, including bacteria, archaea, and tiny animals, living in the depths of the ocean. This ecosystem, which has been hidden from human view until now, is believed to play a vital role in the ocean's nutrient cycle and climate regulation. The scientists hope that their findings will deepen our understanding of the complex interactions between the ocean and the atmosphere and help to inform efforts to protect our planet's fragile ecosystems.")
            ->create();
    }
}
