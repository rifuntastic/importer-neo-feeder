<?php

namespace App\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class ModeComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('mode', Setting::find(1));
    }
}
