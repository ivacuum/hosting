<?php namespace App\Http\Livewire\Acp;

use App\Http\Livewire\WithGoto;
use App\News;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class NewsForm extends Component
{
    use AuthorizesRequests;
    use WithGoto;

    public News $news;

    public function rules()
    {
        return [
            'news.title' => 'required',
            'news.status' => 'required',
            'news.markdown' => 'required',
        ];
    }

    public function submit()
    {
        $this->authorize('create', $this->news);
        $this->validate();
        $this->store();

        return redirect()->to($this->goto ?? to('acp/news'));
    }

    private function store()
    {
        if (!$this->news->exists) {
            $this->news->locale = \App::getLocale();
            $this->news->user_id = request()->user()->id;
        }

        $this->news->save();
    }
}
