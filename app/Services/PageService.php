<?php
namespace App\Services;
use App\Models\Page;
use DB;

class PageService{

    public function getDefaultPage()
    {
        return Page::defaultPage()->with('pages')->get();
    }

    public function getPages(){
        return Page::with('parent:id,title')->get();
    }

    public function getSinglePage($slug){
        $slugs = explode('/', $slug);
        return Page::where('slug',end($slugs))
                ->with('pages')
                ->first();
    }

    public function add($title, $content, $parent_id){
        Page::create([
            'title'     => $title,
            'content'   => $content,
            'parent_id' => $parent_id,
        ]);
    }

    public function edit($id){
        return Page::notDefaultPage()->findOrFail($id);
    }

    public function update($id,$title,$content,$parent_id){
        $page = Page::notDefaultPage()->findOrFail($id);
        $page->update([
            'title' => $title,
            'content' => $content,
            'parent_id' => $parent_id,
        ]);
    }

    public function remove($id){
        DB::transaction(function () use($id){
            $page = Page::notDefaultPage()->findOrFail($id);
            $page->pages()->delete();
            $page->delete();
        });
    }
}