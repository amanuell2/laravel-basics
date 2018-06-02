<?php
/**
 * Created by PhpStorm.
 * User: Amanuel
 * Date: 5/13/2018
 * Time: 2:38 PM
 */

namespace App\Http\ViewComposer;

use Illuminate\View\View;
use \App\Http\Repository\asideRepository;

class asideComposer
{
    public $asideCategories = [];
    public $getAsideAchieves = [];

    public function __construct(asideRepository $aside)
    {
        $this->asideCategories = $aside->getAsideCategories();
        $this->getAsideAchieves=$aside->getAsideArchives();
    }

    /* bind the data to the view
    *@param view $view
     * @return void
     */
    public function composer(View $view)
    {
        $view->with('aside', end($this->asideCategories,$this->getAsideAchieves));

    }
}