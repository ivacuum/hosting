@extends('docs.base')

<?php $freebsdVersion = '13.0' ?>

@section('content')
<h2>Сниппеты для выполнения различных задач на ОС FreeBSD</h2>

<div class="grid gap-8">
  <x-terminal>
    <div class="grid gap-6">
      <div>
        <div class="text-muted"># Обновление ОС</div>
        <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=freebsd-update">freebsd-update</a> fetch install</div>
        <div class="prepend-dollar">freebsd-update upgrade -r {{ $freebsdVersion }}-RELEASE</div>
        <div class="prepend-dollar">freebsd-update install</div>
        <div class="prepend-dollar">shutdown -r now</div>
        <div class="prepend-dollar">freebsd-update install</div>
      </div>

      <div>
        <div class="text-muted"># После больших обновлений вроде 10.0 => 11.0 добавляется две команды</div>
        <div class="prepend-dollar">synth upgrade-system</div>
        <div class="prepend-dollar">freebsd-update install</div>
      </div>

      <div>
        <div class="text-muted"># Обновление портов</div>
        <div class="prepend-dollar">portsnap fetch update</div>
        <div class="prepend-dollar">synth status</div>
        <div class="prepend-dollar">synth upgrade-system</div>
      </div>
    </div>
  </x-terminal>

  <x-terminal>
    <div class="text-muted"># Чистка портов</div>
    <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=pkg">pkg</a> clean</div>
  </x-terminal>

  <x-terminal>
    <div class="text-muted"># Исходники ядра</div>
    <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=fetch">fetch</a> https://mirror.yandex.ru/freebsd/releases/amd64/{{ $freebsdVersion }}-RELEASE/src.txz</div>
    <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=tar">tar</a> -C / -xzf src.txz</div>
  </x-terminal>

  <x-terminal>
    <div class="text-muted"># Генерация зашифрованного пароля</div>
    <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=openssl">openssl</a> passwd -1</div>
  </x-terminal>

  <x-terminal>
    <div class="text-muted"># Билд ядра</div>
    <div class="prepend-dollar">cd /usr/src</div>
    <div class="prepend-dollar">make buildkernel KERNCONF=HOSTING</div>
    <div class="prepend-dollar">make installkernel KERNCONF=HOSTING</div>
  </x-terminal>

  <x-terminal>
    <div class="text-muted"># Первоначальная подготовка портов</div>
    <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=portsnap">portsnap</a> fetch extract</div>
  </x-terminal>

  <x-terminal>
    <div class="text-muted"># Очистка очереди exim</div>
    <div class="prepend-dollar">exim -bp | exiqgrep -i | xargs exim -Mrm</div>
  </x-terminal>

  <x-terminal>
    <div class="text-muted"># Установка модулей npm для jenkins</div>
    <div class="prepend-dollar">npm install --global gulp-cli</div>
  </x-terminal>

  <x-terminal>
    <div class="grid gap-6">
      <div class="text-muted"># Утилиты</div>

      <div>
        <div class="text-muted"># Активные файлы</div>
        <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=fstat">fstat</a></div>
      </div>

      <div>
        <div class="text-muted"># Статистика по дискам</div>
        <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=gstat">gstat</a></div>
      </div>

      <div>
        <div class="text-muted"># Состояние ввода-вывода</div>
        <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=iostat">iostat</a></div>
      </div>

      <div>
        <div class="text-muted"># Состояние сети</div>
        <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=netstat">netstat</a></div>
      </div>

      <div>
        <div class="text-muted"># Системная статистика</div>
        <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=systat">systat</a> [-ifstat | -iostat | -netstat | -tcp | -vmstat] [<em>refresh interval in seconds</em>]</div>
      </div>

      <div>
        <div class="text-muted"># Состояние виртуальной памяти</div>
        <div class="prepend-dollar"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=vmstat">vmstat</a> [-iz] [<em>wait</em>]</div>
      </div>
    </div>
  </x-terminal>

  <x-terminal>
    <div class="grid gap-6">
      <div>
        <div class="text-muted"># Создание файла подкачки на 2048 МБ</div>
        <div class="prepend-dollar">dd if=/dev/zero of=/usr/swap0 bs=1m count=2048</div>
        <div class="prepend-dollar">chmod 0600 /usr/swap0</div>
      </div>

      <div>
        <div class="text-muted"># Добавление записи в /etc/fstab для использования при следующей загрузке системы</div>
        <div>md99 none swap sw,file=/usr/swap0,late 0 0</div>
      </div>

      <div>
        <div class="text-muted"># Активация файла подкачки без перезагрузки</div>
        <div class="prepend-dollar">swapon -aL</div>
      </div>
    </div>
  </x-terminal>

  <x-terminal>
    <div class="text-muted"># Обновление jenkins без обновления openjdk</div>
    <div class="prepend-dollar">portmaster -bdg -x openjdk8 devel/jenkins-lts</div>
  </x-terminal>

  <x-terminal>
    <div class="text-muted"># Смена оболочки по умолчанию</div>
    <div class="prepend-dollar">chsh -s /bin/bash</div>
    <div class="prepend-dollar">sudo chsh -s /bin/bash username</div>
  </x-terminal>
</div>

<div class="mt-6">Больше полезностей на <a class="link" href="https://www.cyberciti.biz/faq/category/freebsd/" rel="nofollow">cyberciti.biz</a>.</div>
@endsection
