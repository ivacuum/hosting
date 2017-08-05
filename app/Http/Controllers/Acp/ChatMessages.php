<?php namespace App\Http\Controllers\Acp;

use App\ChatMessage as Model;
use Illuminate\Database\Eloquent\Builder;
use Ivacuum\Generic\Controllers\Acp\Controller;

class ChatMessages extends Controller
{
    public function index()
    {
        $status = $this->request->input('status');
        $user_id = $this->request->input('user_id');

        $models = Model::with('user')
            ->orderBy('id', 'desc')
            ->unless(is_null($status), function (Builder $query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($user_id, function (Builder $query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->paginate();

        return view($this->view, compact('models', 'status', 'user_id'));
    }

    protected function rules($model = null)
    {
        return [
            'text' => 'required',
            'status' => 'required',
        ];
    }
}
