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

        $archive=Post::orderBy('created_at','desc')->whereNotNull('created_at')->get()->groupBy(function (Post $post){
            return $post->created_at->format('Y');
        })->map(function ($item){
            return $item->sortByDesc('created_at')->groupBy(function ($item){
                return $item->created_at->format('F');
            });
        });

        return $archive;
    }


}