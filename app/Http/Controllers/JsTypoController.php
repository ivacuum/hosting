<?php namespace App\Http\Controllers;

use App\Events\TypoReceived;
use App\Http\Requests\TypoStoreForm;

class JsTypoController
{
    public function __invoke(TypoStoreForm $request)
    {
        if (!$request->page) {
            return response()->json([
                'status' => 'error',
                'message' => 'На какой странице ошибка?',
            ], 422);
        }

        event(new TypoReceived($request->selection, $request->page));

        return response()->json([
            'status' => 'OK',
            'message' => 'Спасибо за информацию об ошибке',
        ], 201);
    }
}
