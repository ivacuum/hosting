@extends('docs.base', [
  'meta_title' => 'FreeBSD · Сниппеты для выполнения различных задач',

  'breadcrumbs' => [
    ['title' => 'Документация', 'url' => 'docs'],
    ['title' => 'FreeBSD'],
  ]
])

@php ($freebsd_version = '11.1')

@section('content')
<h2>Сниппеты для выполнения различных задач на ОС FreeBSD</h2>

<div class="shortcuts-item">
<pre class="terminal">
<span class="terminal-comment"># Обновление ОС</span>
<span class="terminal-command"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=freebsd-update">freebsd-update</a> fetch install</span>
<span class="terminal-command">freebsd-update upgrade -r {{ $freebsd_version }}-RELEASE</span>
<span class="terminal-command">freebsd-update install</span>
<span class="terminal-command">shutdown -r now</span>
<span class="terminal-command">freebsd-update install</span>

<span class="terminal-comment"># После больших обновлений вроде 10.0 => 11.0 добавляется две команды</span>
<span class="terminal-command">portmaster -Raf</span>
<span class="terminal-command">freebsd-update install</span>
</pre>
</div>

<div class="shortcuts-item">
<pre>
<span class="terminal-comment"># Чистка портов</span>
<span class="terminal-command"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=pkg">pkg</a> clean</span>
</pre>
</div>

<div class="shortcuts-item">
<pre>
<span class="terminal-comment"># Исходники ядра</span>
<span class="terminal-command"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=fetch">fetch</a> http://mirror.yandex.ru/freebsd/releases/amd64/{{ $freebsd_version }}-RELEASE/src.txz</span>
<span class="terminal-command"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=tar">tar</a> -C / -xzf src.txz</span>
</pre>
</div>

<div class="shortcuts-item">
<pre>
<span class="terminal-comment"># Генерация зашифрованного пароля</span>
<span class="terminal-command"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=openssl">openssl</a> passwd -1</span>
</pre>
</div>

<div class="shortcuts-item">
<pre>
<span class="terminal-comment"># Билд ядра</span>
<span class="terminal-command">cd /usr/src</span>
<span class="terminal-command">make buildkernel KERNCONF=HOSTING</span>
<span class="terminal-command">make installkernel KERNCONF=HOSTING</span>
</pre>
</div>

<div class="shortcuts-item">
<pre>
<span class="terminal-comment"># Первоначальная подготовка портов</span>
<span class="terminal-command"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=portsnap">portsnap</a> fetch extract</span>
</pre>
</div>

<div class="shortcuts-item">
<pre>
<span class="terminal-comment"># Очистка очереди exim</span>
<span class="terminal-command">exim -bp | exiqgrep -i | xargs exim -Mrm</span>
</pre>
</div>

<div class="shortcuts-item">
<pre>
<span class="terminal-comment"># Установка модулей npm для jenkins</span>
<span class="terminal-command">npm install --global gulp-cli</span>
</pre>
</div>

<div class="shortcuts-item">
<pre>
<span class="terminal-comment"># Утилиты</span>

<span class="terminal-comment"># Активные файлы</span>
<span class="terminal-command"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=fstat">fstat</a></span>

<span class="terminal-comment"># Статистика по дискам</span>
<span class="terminal-command"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=gstat">gstat</a></span>

<span class="terminal-comment"># Состояние ввода-вывода</span>
<span class="terminal-command"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=iostat">iostat</a></span>

<span class="terminal-comment"># Состояние сети</span>
<span class="terminal-command"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=netstat">netstat</a></span>

<span class="terminal-comment"># Системная статистика</span>
<span class="terminal-command"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=systat">systat</a> [-ifstat | -iostat | -netstat | -tcp | -vmstat] [<em>refresh interval in seconds</em>]</span>

<span class="terminal-comment"># Состояние виртуальной памяти</span>
<span class="terminal-command"><a class="link" href="https://www.freebsd.org/cgi/man.cgi?query=vmstat">vmstat</a> [-iz] [<em>wait</em>]</span>
</pre>
</div>

<div class="shortcuts-item">
<pre>
<span class="terminal-comment"># Файл подкачки на 1024 МБ</span>
<span class="terminal-command">dd if=/dev/zero of=/root/swap1 bs=1m count=1024</span>
<span class="terminal-command">chmod 0600 /root/swap1</span>

<span class="terminal-comment"># Добавление записи в /etc/fstab</span>
<span>md99 none swap sw,file=/root/swap1 0 0</span>

<span class="terminal-comment"># Активация файла подкачки без перезагрузки</span>
<span class="terminal-command">swapon -aq</span>
</pre>
</div>

<div class="shortcuts-item">
<pre>
<span class="terminal-comment"># Обновление jenkins без обновления openjdk</span>
<span class="terminal-command">portmaster -bdg -x openjdk8 devel/jenkins-lts</span>
</pre>
</div>

<div>Больше полезностей на <a class="link" href="http://www.cyberciti.biz/faq/category/freebsd/" rel="nofollow">cyberciti.biz</a>.</div>
@endsection
