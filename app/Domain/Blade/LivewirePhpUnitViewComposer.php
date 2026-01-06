<?php

namespace App\Domain\Blade;

use App\Domain\Blade\Action\AppendViewSharedVarsAction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LivewirePhpUnitViewComposer
{
    public function __construct(
        private AppendViewSharedVarsAction $appendViewSharedVars,
        private Request $request,
    ) {}

    public function compose(View $view)
    {
        if (!str_contains($view->getName(), '/resources/views/livewire/')) {
            return;
        }

        $this->appendViewSharedVars->execute($this->request);
    }
}
