<?php namespace Tests\Unit;

use App\Action\FilterNullsAction;
use Tests\TestCase;

class FilterNullsActionTest extends TestCase
{
    public function testOk()
    {
        $action = new FilterNullsAction;

        $this->assertSame([
            'text' => 'string',
            'chat_id' => 1,
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'Yes',
                            'callback_data' => 'secret:yes',
                        ],
                    ],
                    [
                        [
                            'url' => 'https://example.com',
                            'text' => 'Link',
                        ],
                    ],
                ],
            ],
            'json_serializable' => [
                'string' => 'string',
                'int' => 0,
                'array' => [
                    'string' => 'string',
                    'int' => 0,
                    'array' => [],
                ],
            ],
        ], $action->execute([
            'null' => null,
            'text' => 'string',
            'chat_id' => 1,
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        [
                            'url' => null,
                            'text' => 'Yes',
                            'callback_data' => 'secret:yes',
                        ],
                    ],
                    [
                        [
                            'url' => 'https://example.com',
                            'text' => 'Link',
                            'callback_data' => null,
                        ],
                    ],
                ],
                'help' => null,
            ],
            'json_serializable' => [
                'string' => new class implements \JsonSerializable {
                    public function jsonSerialize()
                    {
                        return 'string';
                    }
                },
                'null' => new class implements \JsonSerializable {
                    public function jsonSerialize()
                    {
                        return null;
                    }
                },
                'int' => new class implements \JsonSerializable {
                    public function jsonSerialize()
                    {
                        return 0;
                    }
                },
                'array' => new class implements \JsonSerializable {
                    public function jsonSerialize()
                    {
                        return [
                            'string' => 'string',
                            'int' => 0,
                            'null' => null,
                            'array' => [],
                        ];
                    }
                },
            ],
        ]));
    }
}
