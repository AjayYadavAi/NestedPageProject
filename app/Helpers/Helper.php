<?php
namespace App\Helpers;
use App\Models\Page;
use Illuminate\Support\Str;

class Helper{

    public static function fullslug($parent_id, $slug=''){
        $page = Page::whereId($parent_id)
                ->where('parent_id','!=',0)
                ->select('slug','parent_id')
                ->first();
        if($page){
            $slug = $page->slug.'/'.$slug;
            $slug = self::fullslug($page->parent_id,$slug);
        }
        return $slug;
    }

    public static function pageSlug($title){
        $slug = Str::slug($title);
        $page_count = Page::whereSlug($slug)->count();
        return $page_count > 0 ? $slug.$page_count : $slug;
    }

}