<?php

namespace App\Domain\Rto;

class RtoFake
{
    public static function parseTopicBody(int $topicId, string $body, string $announcer): array
    {
        return [
            "https://rutracker.org/forum/viewtopic.php?t={$topicId}" => RtoTopicHtmlResponse::fakeSuccess($body, $announcer),
        ];
    }

    public static function topicDataByIds(RtoTopicData ...$topics): array
    {
        $ids = rawurlencode(collect($topics)->implode('id', ','));

        return [
            "https://api.rutracker.cc/v1/get_tor_topic_data?by=topic_id&val={$ids}" => RtoGetTorTopicDataResponse::fakeSuccess(...$topics),
        ];
    }

    public static function topicDataByIdsNotFound(int $id): array
    {
        return [
            "https://api.rutracker.cc/v1/get_tor_topic_data?by=topic_id&val={$id}" => RtoGetTorTopicDataResponse::fakeNotFound($id),
        ];
    }

    public static function topicDataByIdsTemporarilyUnavailable(int ...$ids): array
    {
        $ids = rawurlencode(implode(',', $ids));

        return [
            "https://api.rutracker.cc/v1/get_tor_topic_data?by=topic_id&val={$ids}" => RtoGetTorTopicDataResponse::fakeTemporarilyUnavailable(),
        ];
    }

    public static function topicDataByIdsTooManyTopics(): array
    {
        $ids = rawurlencode(implode(',', range(1, 100)));

        return [
            "https://api.rutracker.cc/v1/get_tor_topic_data?by=topic_id&val={$ids}" => RtoGetTorTopicDataResponse::fakeTooManyTopics(),
        ];
    }

    public static function topicIdByHashInvalid(string $hash): array
    {
        return [
            'https://api.rutracker.cc/v1/get_topic_id?by=hash&val=' . rawurlencode($hash) => RtoTopicIdResponse::fakeInvalidHash(),
        ];
    }
}
