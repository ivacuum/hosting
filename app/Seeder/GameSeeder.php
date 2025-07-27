<?php

namespace App\Seeder;

use App\Domain\Game\Factory\GameFactory;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run()
    {
        GameFactory::new()
            ->withSteamId(646570)
            ->withTitle('Slay the Spire')
            ->withSlug('slay-the-spire')
            ->withShortDescriptionEn('We fused card games and roguelikes together to make the best single player deckbuilder we could. Craft a unique deck, encounter bizarre creatures, discover relics of immense power, and Slay the Spire!')
            ->withShortDescriptionRu('Мы смешали жанры ККИ и «рогалик» в попытке предоставить вам нашу лучшую одиночную карточную стратегию. Вам предстоит собрать уникальную колоду, встретить множество причудливых монстров, найти разнообразные могущественные реликвии и повергнуть Шпиль!')
            ->withReleasedAt('2019-01-23')
            ->create();

        GameFactory::new()
            ->withSteamId(1086940)
            ->withTitle("Baldur's Gate 3")
            ->withSlug('baldurs-gate-3')
            ->withShortDescriptionEn('Baldur’s Gate 3 is a story-rich, party-based RPG set in the universe of Dungeons &amp; Dragons, where your choices shape a tale of fellowship and betrayal, survival and sacrifice, and the lure of absolute power.')
            ->withShortDescriptionRu('Соберите отряд и вернитесь в Забытые Королевства. Вас ждет история о дружбе и предательстве, выживании и самопожертвовании, о сладком зове абсолютной власти.')
            ->withReleasedAt('2023-08-03')
            ->create();

        GameFactory::new()
            ->withSteamId(480490)
            ->withTitle('Prey')
            ->withSlug('prey')
            ->withShortDescriptionEn('In Prey, you awaken aboard Talos I, a space station orbiting the moon in the year 2032. You are the key subject of an experiment meant to alter humanity forever – but things have gone terribly wrong. The space station has been overrun by hostile aliens and you are now being hunted.')
            ->withShortDescriptionRu('В игре Prey в 2032 году вы просыпаетесь на борту «Талоса 1», орбитальной космической станции. Вы ключевая часть эксперимента, который должен был навсегда изменить человеческую расу, но привел к катастрофическим последствиям. Космическую станцию захватили враждебные пришельцы, которые теперь ведут на вас охоту.')
            ->withReleasedAt('2017-05-04')
            ->withFinishedAt('2023-06-03')
            ->create();

        GameFactory::new()
            ->withSteamId(594650)
            ->withTitle('Hunt: Showdown 1896')
            ->withSlug('hunt-showdown')
            ->withShortDescriptionEn('Hunt: Showdown 1896 is a new era of the addictively unforgiving extraction shooter. In corrupted backwaters lost to history, fight back alone – or with friends – against timeless evil. Twisted monsters and other ruthless Hunters stand between you and your Bounty. Risk everything as Hunt consumes you')
            ->withShortDescriptionRu('Убивайте оскверненных на забытых всеми болотах. Боритесь с извечным злом, которое стравливает вас с изувеченными чудовищами и другими полными отчаяния Охотниками. В этом тактическом PvPvE-шутере от первого лица вы действуете в одиночку или малой группой. Помните, что ставки высоки.')
            ->withReleasedAt('2019-08-27')
            ->create();

        GameFactory::new()
            ->withSteamId(1551360)
            ->withTitle('Forza Horizon 5')
            ->withSlug('forza-horizon-5')
            ->withShortDescriptionEn('Explore the vibrant open world landscapes of Mexico with limitless, fun driving action in the world’s greatest cars.')
            ->withShortDescriptionRu('Исследуйте яркие пейзажи Мексики в открытом мире с безграничным, захватывающим движением на лучших в мире автомобилях.')
            ->withReleasedAt('2021-11-08')
            ->create();

        GameFactory::new()
            ->withSteamId(1293830)
            ->withTitle('Forza Horizon 4')
            ->withSlug('forza-horizon-4')
            ->withShortDescriptionEn('Dynamic seasons change everything at the world’s greatest automotive festival. Go it alone or team up with others to explore beautiful and historic Britain in a shared open world.')
            ->withShortDescriptionRu('Времена года полностью меняют облик главного автомобильного фестиваля планеты. Исследуйте чудесные пейзажи и исторические достопримечательности Великобритании, путешествуя по открытому миру в одиночку или вместе с другими игроками.')
            ->withReleasedAt('2021-03-09')
            ->create();

        GameFactory::new()
            ->withSteamId(1235140)
            ->withTitle('Yakuza: Like a Dragon')
            ->withSlug('yakuza-like-a-dragon')
            ->withShortDescriptionEn('Become Ichiban Kasuga, a low-ranking yakuza grunt left on the brink of death by the man he trusted most. Take up your legendary bat and get ready to crack some underworld skulls in dynamic RPG combat set against the backdrop of modern-day Japan.')
            ->withShortDescriptionRu('Become Ichiban Kasuga, a low-ranking yakuza grunt left on the brink of death by the man he trusted most. Take up your legendary bat and get ready to crack some underworld skulls in dynamic RPG combat set against the backdrop of modern-day Japan.')
            ->withReleasedAt('2020-11-10')
            ->create();

        GameFactory::new()
            ->withSteamId(1145350)
            ->withTitle('Hades II')
            ->withSlug('hades-2')
            ->withShortDescriptionEn('Battle beyond the Underworld using dark sorcery to take on the Titan of Time in this bewitching sequel to the award-winning rogue-like dungeon crawler.')
            ->withShortDescriptionRu('Обуздайте тёмную магию и выйдите за пределы подземного мира, чтобы бросить вызов титану времени, в этом захватывающем продолжении титулованной игры в жанре rogue-like.')
            ->withReleasedAt('2024-05-06')
            ->create();

        GameFactory::new()
            ->withSteamId(1426210)
            ->withTitle('It Takes Two')
            ->withSlug('it-takes-two')
            ->withShortDescriptionEn('Embark on the craziest journey of your life in It Takes Two. Invite a friend to join for free with Friend’s Pass and work together across a huge variety of gleefully disruptive gameplay challenges. Winner of GAME OF THE YEAR at the Game Awards 2021.')
            ->withShortDescriptionRu('Отправьтесь в самое безумное путешествие в жизни в игре It Takes Two. Пригласите друга присоединиться бесплатно благодаря версии для друга*, радостно преодолевая многочисленные испытания.')
            ->withReleasedAt('2021-03-25')
            ->create();

        GameFactory::new()
            ->withSteamId(337000)
            ->withTitle('Deus Ex: Mankind Divided')
            ->withSlug('deus-ex-mankind-divided')
            ->withShortDescriptionEn("You play as Adam Jensen, an experienced covert operative operating in a world that despises his kind: augmented humans. Choose from an arsenal of state-of-the-art weapons and augmentations to build your playstyle, and decide who you'll trust, to unravel a vast worldwide conspiracy.")
            ->withShortDescriptionRu('На дворе 2029 год. Общество отвергло людей, установивших механические аугментации, и превратило их в совершенных изгоев.')
            ->withReleasedAt('2016-08-23')
            ->create();

        GameFactory::new()
            ->withSteamId(632470)
            ->withTitle('Disco Elysium - The Final Cut')
            ->withSlug('disco-elysium')
            ->withShortDescriptionEn('Disco Elysium - The Final Cut is a groundbreaking role playing game. You’re a detective with a unique skill system at your disposal and a whole city to carve your path across. Interrogate unforgettable characters, crack murders or take bribes. Become a hero or an absolute disaster of a human being.')
            ->withShortDescriptionRu('Disco Elysium - The Final Cut — революция в жанре РПГ. Ваш персонаж — детектив с уникальными навыками, которому предстоит исследовать целый район. Допрашивайте персонажей, расследуйте убийства или берите взятки. Кем вы станете: героем или неудачником?')
            ->withReleasedAt('2019-10-15')
            ->create();

        GameFactory::new()
            ->withSteamId(292030)
            ->withTitle('The Witcher 3: Wild Hunt')
            ->withSlug('witcher-3')
            ->withShortDescriptionEn('You are Geralt of Rivia, mercenary monster slayer. Before you stands a war-torn, monster-infested continent you can explore at will. Your current contract? Tracking down Ciri — the Child of Prophecy, a living weapon that can alter the shape of the world.')
            ->withShortDescriptionRu('Вы — Геральт из Ривии, наемный убийца чудовищ. Вы путешествуете по миру, в котором бушует война и на каждом шагу подстерегают чудовища. Вам предстоит выполнить заказ и найти Цири — Дитя Предназначения, живое оружие, способное изменить облик этого мира.')
            ->withReleasedAt('2015-05-18')
            ->create();

        GameFactory::new()
            ->withSteamId(1145360)
            ->withTitle('Hades')
            ->withSlug('hades')
            ->withShortDescriptionEn('Defy the god of the dead as you hack and slash out of the Underworld in this rogue-like dungeon crawler from the creators of Bastion, Transistor, and Pyre.')
            ->withShortDescriptionRu('Бросьте вызов богу мёртвых и прорубите себе путь из Подземного мира в игре в жанрах «рогалик» и «данжен-кроулер» от создателей Bastion, Transistor и Pyre.')
            ->withReleasedAt('2020-09-17')
            ->create();

        GameFactory::new()
            ->withSteamId(1091500)
            ->withTitle('Cyberpunk 2077')
            ->withSlug('cyberpunk-2077')
            ->withShortDescriptionEn('Cyberpunk 2077 is an open-world, action-adventure RPG set in the dark future of Night City — a dangerous megalopolis obsessed with power, glamor, and ceaseless body modification.')
            ->withShortDescriptionRu('Cyberpunk 2077 — приключенческая ролевая игра с открытым миром, действие которой происходит в футуристическом мегаполисе Найт-Сити, где выше всего ценятся власть, роскошь и модификации тела.')
            ->withReleasedAt('2020-12-09')
            ->create();

        GameFactory::new()
            ->withSteamId(1850570)
            ->withTitle("DEATH STRANDING DIRECTOR'S CUT")
            ->withSlug('death-stranding')
            ->withShortDescriptionEn('From legendary game creator Hideo Kojima comes a genre-defying experience, now expanded in this definitive DIRECTOR’S CUT. As Sam Bridges, your mission is to deliver hope to humanity by connecting the last survivors of a decimated America. Can you reunite the shattered world, one step at a time?')
            ->withShortDescriptionRu('Легендарный творец Хидэо Кодзима представляет окончательную версию DIRECTOR’S CUT знаковой для жанра игры. Действуя от лица Сэма Бриджеса и объединяя последних выживших на территории Америки, вам предстоит возродить надежду человечества. Удастся ли вам шаг за шагом воссоединить разрушенный мир?')
            ->withReleasedAt('2022-03-30')
            ->create();

        GameFactory::new()
            ->withSteamId(739630)
            ->withTitle('Phasmophobia')
            ->withSlug('phasmophobia')
            ->withShortDescriptionEn('Phasmophobia is a 4 player online co-op psychological horror. Paranormal activity is on the rise and it’s up to you and your team to use all the ghost-hunting equipment at your disposal in order to gather as much evidence as you can.')
            ->withShortDescriptionRu('Phasmophobia is a 4 player online co-op psychological horror. Paranormal activity is on the rise and it’s up to you and your team to use all the ghost-hunting equipment at your disposal in order to gather as much evidence as you can.')
            ->withReleasedAt('2020-09-18')
            ->create();

        GameFactory::new()
            ->withSteamId(403640)
            ->withTitle('Dishonored 2')
            ->withSlug('dishonored-2')
            ->withShortDescriptionEn("Reprise your role as a supernatural assassin in Dishonored 2. Declared a “masterpiece” by Eurogamer and hailed “a must-play revenge tale” by Game Informer, Dishonored 2 is the follow up to Arkane’s 1st-person action blockbuster &amp; winner of 100+ 'Game of the Year' awards, Dishonored.")
            ->withShortDescriptionRu('В игре Dishonored 2, вы снова окажетесь в роли ассасина со сверхъестественными способностями. Сайт IGN назвал эту игру «удивительной» и «идеальным продолжением», Eurogamer признал ее «шедевром», а Game Informer считает, что «эта история о мести – одна из лучших в своем жанре и проходить мимо нее ни в коем случае нельзя»; Dishonored 2 –...')
            ->withReleasedAt('2016-11-11')
            ->create();

        GameFactory::new()
            ->withSteamId(435150)
            ->withTitle('Divinity: Original Sin 2 - Definitive Edition')
            ->withSlug('divinity-original-sin-2')
            ->withShortDescriptionEn("The critically acclaimed RPG that raised the bar, from the creators of Baldur's Gate 3. Gather your party. Master deep, tactical combat. Venture as a party of up to four - but know that only one of you will have the chance to become a God.")
            ->withShortDescriptionRu("Знаменитая ролевая игра от разработчиков Baldur's Gate 3. Соберите отряд. Освойте мощную боевую систему. Пригласите с собой до трех друзей, но помните, что только один из вас сможет стать богом.")
            ->withReleasedAt('2017-09-14')
            ->create();

        GameFactory::new()
            ->withSteamId(2322010)
            ->withTitle('God of War Ragnarök')
            ->withSlug('god-of-war-ragnarok')
            ->withShortDescriptionEn('Kratos and Atreus embark on a mythic journey for answers before Ragnarök arrives – now on PC.')
            ->withShortDescriptionRu('Кратос и Атрей отправляются на поиски ответов в преддверии неотвратимо надвигающегося Рагнарёка. Теперь игра доступна и на PC.')
            ->withReleasedAt('2024-09-19')
            ->create();

        GameFactory::new()
            ->withSteamId(2072450)
            ->withTitle('Like a Dragon: Infinite Wealth')
            ->withSlug('like-a-dragon-infinite-wealth')
            ->withShortDescriptionEn('Two larger-than-life heroes, Ichiban Kasuga and Kazuma Kiryu are brought together by the hand of fate, or perhaps something more sinister… Live it up in Japan and explore all that Hawaii has to offer in an RPG adventure so big it spans the Pacific.')
            ->withShortDescriptionRu('Два легендарных героя, которых свела вместе судьба — или нечто куда более зловещее… Гуляйте по Японии и развлекайтесь на Гавайях в этом масштабном приключении размером с Тихий океан.')
            ->withReleasedAt('2024-01-25')
            ->create();

        GameFactory::new()
            ->withSteamId(1282100)
            ->withTitle('REMNANT II®')
            ->withSlug('remnant-2')
            ->withShortDescriptionEn('REMNANT II® pits survivors of humanity against new deadly creatures and god-like bosses across terrifying worlds. Play solo or co-op with two other friends to explore the depths of the unknown to stop an evil from destroying reality itself.')
            ->withShortDescriptionRu('Remnant II® — продолжение крайне успешной игры Remnant: From the Ashes. Выжившим представителям человечества предстоит отправиться в жуткие миры и вступить в бой с новыми беспощадными тварями и богоподобными боссами.')
            ->withReleasedAt('2023-07-25')
            ->create();

        GameFactory::new()
            ->withSteamId(552520)
            ->withTitle('Far Cry® 5')
            ->withSlug('far-cry-5')
            ->withShortDescriptionEn('Discover the open world of Hope County, Montana, besieged by a fanatical doomsday cult. Dive into the action solo or two-player co-op in the story campaign, use a vast arsenal of weapons and allies, and free Hope County from Joseph Seed and his cult.')
            ->withShortDescriptionRu('Округ Хоуп в штате Монтана захвачен фанатиками культа Врата Эдема. Дайте отпор Иосифу Сиду и его братьям. Разожгите огонь сопротивления.')
            ->withReleasedAt('2018-03-26')
            ->create();

        GameFactory::new()
            ->withSteamId(1238000)
            ->withTitle('Mass Effect™: Andromeda Deluxe Edition')
            ->withSlug('mass-effect-andromeda')
            ->withShortDescriptionEn('Return to the Mass Effect universe &amp; lead the first humans in Andromeda on a desperate search for our new home.')
            ->withShortDescriptionRu('В Mass Effect™: Andromeda игроки окажутся в галактике Андромеды, далеко за пределами Млечного Пути.')
            ->withReleasedAt('2020-06-11')
            ->create();

        GameFactory::new()
            ->withSteamId(1237970)
            ->withTitle('Titanfall® 2')
            ->withSlug('titanfall-2')
            ->withShortDescriptionEn('Respawn Entertainment gives you the most advanced titan technology in its new, single player campaign &amp; multiplayer experience. Combine &amp; conquer with new titans &amp; pilots, deadlier weapons, &amp; customization and progression systems that help you and your titan flow as one unstoppable killing force.')
            ->withShortDescriptionRu('Включает весь контент Эксклюзивного цифрового издания, набор «Ключ на старт» для ускоренного развития и разблокировки предметов, а также особую боевую раскраску Underground для карабина R-201.')
            ->withReleasedAt('2020-06-18')
            ->create();
    }
}
