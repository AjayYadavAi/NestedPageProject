<?php

namespace Tests\Feature\Helpers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Page;

class HelperTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_slug()
    {
        $page = Page::create(['title'=>"page 1 title",'content'=>'page1','parent_id'=>1]);
        $this->assertEquals('page-1-title',$page->slug);
    }

    /** @test */
    public function it_can_not_create_duplicate_slug()
    {
        $page = Page::create(['title'=>"page 1 title",'content'=>'page1','parent_id'=>1]);
        $page = Page::create(['title'=>"page 1 title",'content'=>'page1','parent_id'=>1]);
        $this->assertNotEquals('page-1-title',$page->slug);
        $this->assertEquals('page-1-title1',$page->slug);
    }


    /** @test */
    public function it_can_return_full_page_slug()
    {
        $parent_page = Page::create([
            'title'=>"page 1",
            'content'=>'page1',
            'parent_id'=>1
        ]);

        $child_page = Page::create([
            'title'=>"page 2",
            'content'=>'page1',
            'parent_id'=>$parent_page->id
        ]);

        $this->assertEquals($parent_page->slug.'/'.$child_page->slug,$child_page->page_slug);
    }



}
