@extends('docs.base')

<?php $freebsdVersion = '14.2' ?>

@section('table_of_contents')
<x-toc-item href="freebsd-update">Обновление ОС</x-toc-item>
<x-toc-item href="pkg-clean">Чистка пакетов</x-toc-item>
<x-toc-item href="kernel-src">Исходники ядра</x-toc-item>
<x-toc-item href="generate-password">Генерация зашифрованного пароля</x-toc-item>
<x-toc-item href="build-kernel">Билд ядра</x-toc-item>
<x-toc-item href="installing-ports-collection">Первоначальная установка дерева портов</x-toc-item>
<x-toc-item href="purge-exim-queue">Очистка очереди exim старше 1 часа</x-toc-item>
<x-toc-item href="npm-for-jenkins">Установка модулей npm для jenkins</x-toc-item>
<x-toc-item href="utilities">Утилиты</x-toc-item>
<x-toc-item href="swap">Файл подкачки</x-toc-item>
<x-toc-item href="update-jenkins-without-openjdk">Обновление jenkins без обновления openjdk</x-toc-item>
<x-toc-item href="change-shell">Смена оболочки по умолчанию</x-toc-item>
@endsection

@section('content')
@component('documentation-article')
@slot('title')
  @lang('Сниппеты для выполнения различных задач на ОС FreeBSD')
@endslot

<p class="lead">Знак <code>$</code> в начале строк на этой странице означает команду. Он помогает отличить ввод пользователя от вывода программы.</p>

<h2 id="freebsd-update">Обновление ОС</h2>
<x-terminal class="mb-6">
  <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=freebsd-update">freebsd-update</a> fetch install</div>
  <div class="prepend-dollar">freebsd-update upgrade -r {{ $freebsdVersion }}-RELEASE</div>
  <div class="prepend-dollar">freebsd-update install</div>
  <div class="prepend-dollar">shutdown -r now</div>
  <div class="prepend-dollar">freebsd-update install</div>
  <div class="prepend-dollar">find /var/db/freebsd-update/files -type f -delete</div>
</x-terminal>

<p>После больших обновлений вроде перехода с версии 10.0 на 11.0 добавляется две команды:</p>
<x-terminal class="mb-6">
  <div class="prepend-dollar">synth upgrade-system</div>
  <div class="prepend-dollar">freebsd-update install</div>
</x-terminal>

<p>Обновление портов.</p>
<x-terminal class="mb-6">
  <div class="prepend-dollar">cd /usr/ports && make update && make fetchindex</div>
  <div class="prepend-dollar">synth status</div>
  <div class="prepend-dollar">synth upgrade-system</div>
</x-terminal>

<h2 id="pkg-clean">Чистка пакетов</h2>
<p>Можно удалить неактуальный кэш, чтобы высвободить место на диске.</p>
<x-terminal>
  <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=pkg">pkg</a> clean</div>
</x-terminal>

<h2 id="kernel-src">Исходники ядра</h2>
<x-terminal>
  <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=fetch">fetch</a> https://mirror.yandex.ru/freebsd/releases/amd64/{{ $freebsdVersion }}-RELEASE/src.txz</div>
  <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=tar">tar</a> -C / -xzf src.txz</div>
</x-terminal>

<h2 id="generate-password">Генерация зашифрованного пароля</h2>
<x-terminal>
  <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=openssl">openssl</a> passwd -1</div>
</x-terminal>

<h2 id="build-kernel">Билд ядра</h2>
<x-terminal>
  <div class="prepend-dollar">cd /usr/src</div>
  <div class="prepend-dollar">make buildkernel KERNCONF=HOSTING</div>
  <div class="prepend-dollar">make installkernel KERNCONF=HOSTING</div>
</x-terminal>

<h2 id="installing-ports-collection">Первоначальная установка дерева портов</h2>
<x-terminal>
  <div class="prepend-dollar">pkg install git-tiny</div>
  <div class="prepend-dollar">git clone --depth 1 https://git.FreeBSD.org/ports.git /usr/ports</div>
</x-terminal>

<h2 id="purge-exim-queue">Очистка очереди exim старше 1 часа</h2>
<x-terminal>
  <div class="prepend-dollar">exim -bp | exiqgrep -i -o 3600 | xargs exim -Mrm</div>
</x-terminal>

<h2 id="npm-for-jenkins">Установка модулей npm для jenkins</h2>
<x-terminal>
  <div class="prepend-dollar">npm install --global gulp-cli</div>
</x-terminal>

<h2 id="utilities">Утилиты</h2>
<h3>Активные файлы</h3>
<x-terminal>
  <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=fstat">fstat</a></div>
</x-terminal>

<h3>Статистика по дискам</h3>
<x-terminal>
  <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=gstat">gstat</a></div>
</x-terminal>

<h3>Состояние ввода-вывода</h3>
<x-terminal>
  <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=iostat">iostat</a></div>
</x-terminal>

<h3>Состояние сети</h3>
<x-terminal>
  <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=netstat">netstat</a></div>
</x-terminal>

<h3>Системная статистика</h3>
<x-terminal>
  <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=systat">systat</a> [-ifstat | -iostat | -netstat | -tcp | -vmstat] [<em>refresh interval in seconds</em>]</div>
</x-terminal>

<h3>Состояние виртуальной памяти</h3>
<x-terminal>
  <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=vmstat">vmstat</a> [-iz] [<em>wait</em>]</div>
</x-terminal>

<h2 id="swap">Файл подкачки</h2>
<p>При сборках портов вроде <code>lang/rust</code> порой заканчивается память. Файл подкачки помогает не упасть сборщику и все же собрать порт.</p>
<p>Создание файла подкачки на 2048 МБ.</p>
<x-terminal class="mb-6">
  <div class="prepend-dollar">dd if=/dev/zero of=/usr/swap0 bs=1m count=2048</div>
  <div class="prepend-dollar">chmod 0600 /usr/swap0</div>
</x-terminal>

<p>Добавление записи в <code>/etc/fstab</code> для использования при следующей загрузке системы.</p>
<x-terminal class="mb-6">
  <div>md99 none swap sw,file=/usr/swap0,late 0 0</div>
</x-terminal>

<p>Активация файла подкачки без перезагрузки.</p>
<x-terminal>
  <div class="prepend-dollar">swapon -aL</div>
</x-terminal>

<h2 id="update-jenkins-without-openjdk">Обновление jenkins без обновления openjdk</h2>
<x-terminal>
  <div class="prepend-dollar">portmaster -bdg -x openjdk8 devel/jenkins-lts</div>
</x-terminal>

<h2 id="change-shell">Смена оболочки по умолчанию</h2>
<x-terminal>
  <div class="prepend-dollar">chsh -s /bin/bash</div>
  <div class="prepend-dollar">sudo chsh -s /bin/bash username</div>
</x-terminal>

<p class="mt-18">Больше полезностей на <a class="link" href="https://www.cyberciti.biz/faq/category/freebsd/" rel="nofollow">cyberciti.biz</a>.</p>
@endcomponent
@endsection
