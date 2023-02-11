<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('burnables', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->string('rel_type', 40);
            $table->unsignedInteger('rel_id');

            $table->primary(['user_id', 'rel_type', 'rel_id']);
        });

        Schema::create('chat_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->ipAddress('ip');
            $table->unsignedTinyInteger('status');
            $table->text('text');
            $table->text('html');
            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_id')->default(0);
            $table->string('title_ru');
            $table->string('title_en')->default('');
            $table->string('slug');
            $table->char('iata', 3);
            $table->point('point', 4326)->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });

        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->text('text');
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->morphs('rel');
            $table->unsignedTinyInteger('status')->default(App\Domain\CommentStatus::Published->value);
            $table->text('html');
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ru');
            $table->string('title_en')->default('');
            $table->string('slug');
            $table->string('emoji', 20)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->collate('utf8mb4_unicode_ci');
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });

        Schema::create('dcpp_hubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('address');
            $table->unsignedSmallInteger('port')->default(411);
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedTinyInteger('is_online')->default(1);
            $table->unsignedInteger('clicks')->default(0);
            $table->timestamp('queried_at')->nullable();
            $table->timestamps();
        });

        Schema::create('domains', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->string('domain')->unique();
            $table->boolean('status')->unsigned()->default(0);
            $table->boolean('domain_control')->unsigned()->default(0);
            $table->timestamp('registered_at')->nullable();
            $table->timestamp('paid_till')->nullable();
            $table->string('ipv4')->default('');
            $table->string('ipv6')->default('');
            $table->string('mx')->default('');
            $table->string('ns')->default('');
            $table->timestamp('queried_at')->nullable();
            $table->timestamp('mailed_at')->nullable();
            $table->timestamps();
            $table->mediumText('text');
            $table->string('cms_type')->default('');
            $table->string('cms_version')->default('');
            $table->string('cms_url')->default('');
            $table->string('cms_user')->default('');
            $table->string('cms_pass')->default('');
            $table->string('ftp_host')->default('');
            $table->string('ftp_user')->default('');
            $table->string('ftp_pass')->default('');
            $table->string('ssh_host')->default('');
            $table->string('ssh_user')->default('');
            $table->string('ssh_pass')->default('');
            $table->string('db_pma')->default('');
            $table->string('db_host')->default('');
            $table->string('db_user')->default('');
            $table->string('db_pass')->default('');
            $table->integer('yandex_user_id')->unsigned()->default(0)->index();
            $table->integer('alias_id')->unsigned()->default(0);
            $table->integer('orphan')->unsigned()->default(0);
        });

        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('rel_type');
            $table->unsignedInteger('rel_id');
            $table->string('to');
            $table->string('template');
            $table->string('locale', 10);
            $table->unsignedInteger('clicks')->default(0);
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });

        Schema::create('external_http_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_name');
            $table->string('method');
            $table->string('scheme');
            $table->string('host');
            $table->string('path');
            $table->string('query', 2000);
            $table->text('request_headers');
            $table->text('request_body');
            $table->text('response_headers');
            $table->mediumText('response_body');
            $table->unsignedBigInteger('response_size');
            $table->unsignedBigInteger('total_time_us');
            $table->unsignedSmallInteger('http_code');
            $table->string('http_version');
            $table->unsignedInteger('redirect_count');
            $table->unsignedBigInteger('redirect_time_us');
            $table->string('redirect_url');
            $table->timestamps(6);
        });

        Schema::create('external_identities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->default(0);
            $table->string('provider');
            $table->string('uid');
            $table->string('email');
            $table->timestamps();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('favorite_movies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kp_id');
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('is_tv_series')->default(0);
            $table->string('title_ru');
            $table->string('title_en');
            $table->timestamps();
        });

        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('folder');
            $table->string('title');
            $table->string('slug');
            $table->unsignedBigInteger('size')->default(0);
            $table->string('extension', 25);
            $table->unsignedTinyInteger('status')->default(App\Domain\FileStatus::Hidden->value);
            $table->unsignedInteger('downloads')->default(0);
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->string('slug');
            $table->char('date', 6);
            $table->unsignedBigInteger('size')->default(0);
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });

        Schema::create('gigs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('city_id')->default(0);
            $table->unsignedInteger('artist_id')->default(0);
            $table->string('title_ru')->default('');
            $table->string('title_en')->default('');
            $table->string('slug')->default('');
            $table->timestamp('date')->nullable();
            $table->tinyInteger('status')->unsigned()->default(App\Domain\GigStatus::Hidden->value);
            $table->string('meta_title_ru')->default('');
            $table->string('meta_title_en')->default('');
            $table->string('meta_description_ru')->default('');
            $table->string('meta_description_en')->default('');
            $table->string('meta_image')->default('');
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });

        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedTinyInteger('status')->default(App\Domain\IssueStatus::Pending->value);
            $table->string('name');
            $table->string('email');
            $table->string('title');
            $table->mediumText('text');
            $table->string('page');
            $table->timestamps();
        });

        Schema::create('kanji_radical', function (Blueprint $table) {
            $table->integer('radical_id')->unsigned();
            $table->integer('kanji_id')->unsigned()->index();

            $table->primary(['radical_id', 'kanji_id']);
        });

        Schema::create('kanji_similar', function (Blueprint $table) {
            $table->integer('kanji_id')->unsigned();
            $table->integer('similar_id')->unsigned();

            $table->primary(['kanji_id', 'similar_id']);
        });

        Schema::create('kanjis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wk_id')->default(0);
            $table->unsignedTinyInteger('level')->default(0);
            $table->string('character');
            $table->string('meaning');
            $table->string('onyomi');
            $table->string('kunyomi');
            $table->string('important_reading');
            $table->string('nanori');
            $table->timestamps();
        });

        Schema::create('metrics', function (Blueprint $table) {
            $table->date('date');
            $table->string('event');
            $table->unsignedInteger('count')->default(0);

            $table->primary(['date', 'event']);
        });

        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->string('title');
            $table->text('markdown');
            $table->text('html');
            $table->unsignedTinyInteger('status')->default(0);
            $table->string('locale', 10);
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->morphs('rel');
            $table->string('slug');
            $table->char('lat', 12);
            $table->char('lon', 12);
            $table->point('point', 4326)->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });

        Schema::create('radicals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wk_id')->default(0);
            $table->unsignedTinyInteger('level')->default(0);
            $table->string('character');
            $table->string('meaning');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('referrer_redirects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from');
            $table->string('to');
            $table->dateTime('starts_at');
            $table->dateTime('expires_at');
            $table->unsignedInteger('clicks')->default(0);
            $table->timestamps();
        });

        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('host');
            $table->mediumText('text');
            $table->string('ftp_host');
            $table->string('ftp_root');
            $table->string('ftp_user');
            $table->string('ftp_pass');
            $table->timestamps();
        });

        Schema::create('taggable', function (Blueprint $table) {
            $table->unsignedInteger('tag_id');
            $table->unsignedInteger('rel_id');
            $table->string('rel_type', 40);

            $table->primary(['tag_id', 'rel_type', 'rel_id']);
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ru');
            $table->string('title_en');
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });

        Schema::create('torrents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedInteger('category_id')->default(0);
            $table->unsignedInteger('rto_id')->default(0)->unique();
            $table->string('title', 300);
            $table->mediumText('html');
            $table->string('related_query');
            $table->unsignedBigInteger('size')->default(0);
            $table->char('info_hash', 40);
            $table->string('announcer');
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedInteger('clicks')->default(0);
            $table->unsignedInteger('views')->default(0);
            $table->timestamp('registered_at')->nullable();
            $table->timestamps();
        });

        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedInteger('city_id')->default(0);
            $table->string('title_ru')->default('');
            $table->string('title_en')->default('');
            $table->string('slug')->default('');
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->unsignedTinyInteger('status')->default(App\Domain\TripStatus::Inactive->value);
            $table->text('markdown');
            $table->text('html');
            $table->string('meta_title_ru')->default('');
            $table->string('meta_title_en')->default('');
            $table->string('meta_description_ru')->default('');
            $table->string('meta_description_en')->default('');
            $table->string('meta_image')->default('');
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('login')->default('');
            $table->string('password')->default('');
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->string('salt', 5)->default('');
            $table->unsignedTinyInteger('status')->default(0);
            $table->string('locale', 10)->default(App\Domain\Locale::Rus->value);
            $table->unsignedTinyInteger('torrent_short_title')->default(0);
            $table->unsignedTinyInteger('notify_gigs')->default(App\Domain\NotificationDeliveryMethod::Disabled->value);
            $table->unsignedTinyInteger('notify_news')->default(App\Domain\NotificationDeliveryMethod::Disabled->value);
            $table->unsignedTinyInteger('notify_trips')->default(App\Domain\NotificationDeliveryMethod::Disabled->value);
            $table->string('avatar')->default('');
            $table->unsignedInteger('telegram_id')->nullable();
            $table->ipAddress('ip')->default('');
            $table->string('activation_token')->default('');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('password_changed_at')->nullable();
            $table->boolean('is_admin')->unsigned()->default(0);
        });

        Schema::create('vocabularies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wk_id')->default(0);
            $table->unsignedTinyInteger('level')->default(0);
            $table->string('character');
            $table->string('meaning');
            $table->string('kana');
            $table->text('sentences');
            $table->unsignedInteger('female_audio_id')->default(0);
            $table->unsignedInteger('male_audio_id')->default(0);
            $table->timestamps();
        });

        Schema::create('yandex_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account');
            $table->string('token');
            $table->timestamps();
        });
    }
};
