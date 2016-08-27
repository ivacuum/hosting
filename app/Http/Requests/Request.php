<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function forbiddenResponse()
    {
        abort(403);
    }
}
