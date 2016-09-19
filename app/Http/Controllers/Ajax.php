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

        $question = $this->request->input('question');
        $referer  = $this->request->server('HTTP_REFERER');
        $text     = $this->request->input('text');

        register_shutdown_function(function () use ($question, $referer, $text) {
            \Mail::to(config('email.support'))
                ->send(new Feedback($referer, $question, $text));
        });

        return [
            'message' => trans('ajax.feedback.ok'),
            'status'  => 'OK',
        ];
    }
}
