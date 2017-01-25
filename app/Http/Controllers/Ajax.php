<?php namespace App\Http\Controllers;

use App\Mail\Feedback;

class Ajax extends Controller
{
    public function feedback()
    {
        $this->validate($this->request, [
            'mail' => 'empty',
            'text' => 'required',
        ]);

        $text = $this->request->input('text');
        $referer = $this->request->server('HTTP_REFERER');
        $question = $this->request->input('question');

        register_shutdown_function(function () use ($question, $referer, $text) {
            \Mail::send(new Feedback($referer, $question, $text));
        });

        return [
            'message' => trans('ajax.feedback.ok'),
            'status'  => 'OK',
        ];
    }
}
