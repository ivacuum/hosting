<?php

namespace App\Domain\Telegram\Api;

class InlineKeyboardMarkup implements \JsonSerializable
{
    /** @var array<InlineKeyboardButton[]> */
    private array $rows = [];

    public function addRow(InlineKeyboardButton ...$buttons)
    {
        $this->rows[] = $buttons;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'inline_keyboard' => $this->rows,
        ];
    }

    public static function make()
    {
        return new self;
    }
}
