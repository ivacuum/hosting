<?php namespace App\Http\Requests;

use App\User;
use Ivacuum\Generic\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    public function userModel(): User
    {
        return $this->user();
    }
}
