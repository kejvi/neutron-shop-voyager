<?php

namespace App\Widgets;

use App\Office;
use Arrilot\Widgets\AbstractWidget;
use  Auth;

class UserDetails extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $user = Auth::user();
        $office = Office::find($user->office_id);

        return view('widgets.user_details', [
            'config' => $this->config,
            'user' => $user,
            'office' => $office,
            'title' => 'Te Dhenat e User',
        ]);
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return true;
    }
}
