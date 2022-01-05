<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Carbon\Carbon;

class LayoutComposer
{
    protected $toDay;

    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        // $carbon->rawFormat('D, M j, Y g:i A');
        $this->toDay = Carbon::now(+6)->rawFormat('D, j M, Y');
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('today', $this->toDay);
    }
}
