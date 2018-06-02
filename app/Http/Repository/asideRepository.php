<?php
/**
 * Created by PhpStorm.
 * User: Amanuel
 * Date: 5/14/2018
 * Time: 1:06 AM
 */

namespace App\Http\Repository;

use App\post;
use Illuminate\Support\Carbon;


class asideRepository
{
    public function getAsideCategories()
    {
        return [

            $postsType1 = post::where('type', '1')->count(),
            $postsType2 = post::where('type', '2')->count(),
            $postsType3 = post::where('type', '3')->count(),
            $postsType4 = post::where('type', '4')->count(),
            $postsType5 = post::where('type', '5')->count(),
            $postsType6 = post::where('type', '6')->count()
        ];
    }

    public function getAsideArchives()
    {

        return [

            $postsType1 = post::whereYear('created_at', '=', date('2010'))->count(),
            $postsType2 = post::whereYear('created_at', '=', date('2011'))->count(),
            $postsType3 = post::whereYear('created_at', '=', date('2012'))->count(),
            $postsType4 = post::whereYear('created_at', '=', date('2013'))->count(),
            $postsType5 = post::whereYear('created_at', '=', date('2014'))->count(),
            $postsType6 = post::whereYear('created_at', '=', date('2015'))->count(),
            $postsType5 = post::whereYear('created_at', '=', date('2016'))->count(),
            $postsType6 = post::whereYear('created_at', '=', date('2017'))->count(),
            $postsType5 = post::whereYear('created_at', '=', date('2018'))->count(),

        ];
    }


}