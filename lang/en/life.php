<?php

return [
    'date.day_month' => "MMMM[\u{00A0}]D", // April 21
    'date.day_day_month' => "%3\$s\u{00A0}%d–%d", // December 11–23
    'date.day_month_year' => "MMMM[\u{00A0}]D,[\u{00A0}]YYYY", // 1 июня 2016
    'date.day_day_month_year' => "%3\$s\u{00A0}%d–%d,\u{00A0}%4\$d", // June 1–3, 2016
    'date.day_month_day_month' => "%2\$s\u{00A0}%d – %4\$s\u{00A0}%3\$d", // September 27 – October 3
    'date.day_month_day_month_year' => "%2\$s\u{00A0}%d – %4\$s\u{00A0}%3\$d,\u{00A0}%5\$d", // May 27 – June 3, 2016

    'date.comment_date' => "MMMM[\u{00A0}]D [at] LT",
    'date.comment_today' => "[Today], MMMM[\u{00A0}]D [at] LT",
    'date.comment_yesterday' => "[Yesterday], MMMM[\u{00A0}]D [at] LT",
    'date.comment_date_with_year' => "MMMM[\u{00A0}]D, YYYY [at] LT",

    'date.magnet_date' => "MMMM[\u{00A0}]D",
    'date.magnet_today' => "[Today], MMMM[\u{00A0}]D",
    'date.magnet_yesterday' => "[Yesterday], MMMM[\u{00A0}]D",
    'date.magnet_date_with_year' => "MMMM[\u{00A0}]D, YYYY",

    'gigs.rss.description' => 'Stories about attended gigs.',
    'trips.rss.description' => 'Travel stories.',

    'newsletter.description' => 'Get an email when I publish a new story.',
];
