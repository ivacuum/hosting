<?php namespace App\Http\Controllers;

use Ivacuum\Generic\Services\Telegram;

class JsTypo extends Controller
{
    public function __invoke(Telegram $telegram)
    {
        request()->validate(['selection' => 'required|string|min:3|max:200']);

        $page = session()->previousUrl();
        $selection = request('selection');

        if (!$page) {
            return [
                'status' => 'error',
                'message' => 'На какой странице ошибка?',
            ];
        }

        $text = "📝️ Опечатка на странице\n{$page}\n\n".htmlspecialchars_decode($selection, ENT_QUOTES);

        $telegram->notifyAdmin($text);

        return [
            'status' => 'OK',
            'message' => 'Спасибо за информацию об ошибке',
        ];
    }
}
