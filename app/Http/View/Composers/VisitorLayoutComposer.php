<?php

namespace App\Http\View\Composers;

use App\Repositories\LocationRepository;
use Illuminate\View\View;

class VisitorLayoutComposer
{
    /**
     * The user repository implementation.
     *
     * @var LocationeR
     */
    protected $location;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(LocationRepository $location)
    {
        // Dependencies automatically resolved by service container...
        $this->location = $location;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('divisions', $this->location->getDivision());
    }
}
