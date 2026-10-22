<?php

namespace App\Domain\Telegram\Api;

class InlineKeyboardMarkup implements \JsonSerializable
{
    /** @var array<InlineKeyboardButton[]> */
    private array $rows = [];

    public function addRow(InlineKeyboardButton ...$buttons): static
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

    public static function make(): self
    {
        return new self;
    }
}
