Для работы с DKIM нам нужно:
- Поддержка DKIM почтовым сервером для подписывания отправляемой почты;
- Получение пары приватного и публичного ключа;

У Яндекса надо забрать приватный ключ
https://tech.yandex.ru/pdd/doc/reference/dkim-status-docpage/

@ TXT v=spf1 ip4:188.225.73.153 ip6:2a03:6f00:3:3::39 include:_spf.yandex.net -all

@ TXT v=DMARC1; p=none; fo=1; ruf=mailto:admin@kupislona.ru

postmaster.mail.ru
