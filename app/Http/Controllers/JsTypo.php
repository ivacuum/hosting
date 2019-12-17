<?php namespace App\Http\Controllers;

use App\Events\TypoReceived;
use App\Http\Requests\TypoStoreRequest;

class JsTypo extends Controller
{
    public function __invoke(TypoStoreRequest $request)
    {
        $page = $request->page();

        if (!$page) {
            return response()->json([
                'status' => 'error',
                'message' => 'На какой странице ошибка?',
            ], 422);
        }

        event(new TypoReceived($request->selection(), $page));

        return response()->json([
            'status' => 'OK',
            'message' => 'Спасибо за информацию об ошибке',
        ], 201);
    }
}
