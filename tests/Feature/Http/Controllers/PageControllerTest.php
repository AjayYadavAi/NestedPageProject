<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Page;

class PageControllerTest extends TestCase
{
    /** @test  */
    public function it_display_home_page_default_page_content()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Title');
        $response->assertSee('Content');
        $response->assertSee('home page');
    }


    /** @test  */
    public function it_display_home_page_with_nested_pages_link()
    {
        Page::create([
            'title' => 'page1',
            'content' => 'page1',
            'parent_id' => 1
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('page1');
    }

    /** @test  */
    public function it_doesnot_display_another_parent_nested_pages_link()
    {
        $parent = Page::create([
            'title' => 'page1',
            'content' => 'page1',
            'parent_id' => 1 // home page
        ]);
        $child = Page::create([
            'title' => 'page2',
            'content' => 'page2',
            'parent_id' => 2 // page 1
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee($child->title);
    }

    /** @test  */
    public function it_loads_pages_view()
    {
        $response = $this->get('/pages');

        $response->assertStatus(200);
        $response->assertSee('Title');
        $response->assertSee('Content');
    }

    /** @test  */
    public function it_does_not_show_edit_and_delete_button_for_default_page()
    {
        $response = $this->get('/pages');

        $response->assertStatus(200);
        $response->assertDontSee('Edit');
        $response->assertDontSee('Delete');
    }

    /** @test  */
    public function it_shows_edit_and_delete_button_for_nested_page()
    {
        Page::create([
            'title' => 'page1',
            'content' => 'page1',
            'parent_id' => 1
        ]);

        $response = $this->get('/pages');

        $response->assertStatus(200);
        $response->assertSee('Edit');
        $response->assertSee('Delete');
    }


    /** @test  */
    public function it_shows_page_content_with_nested_pages_links()
    {
        $parent = Page::create([
            'title' => 'page1',
            'content' => 'page1',
            'parent_id' => 1 // home page
        ]);
        $child = Page::create([
            'title' => 'page2',
            'content' => 'page2',
            'parent_id' => 2 // page 1
        ]);

        $response = $this->get($parent->page_slug);

        $response->assertStatus(200);
        $response->assertSee($parent->title);
        $response->assertSee($child->title);
    }

    /** @test  */
    public function it_shows_404_page_if_page_slug_is_invalid()
    {
        $parent = Page::create([
            'title' => 'page1',
            'content' => 'page1',
            'parent_id' => 1 // home page
        ]);
        $response = $this->get('invalid-slug/'.$parent->page_slug);

        $response->assertStatus(404);
    }

    /** @test  */
    public function it_shows_404_page_when_page_is_not_found()
    {
        $response = $this->get('page-494-d94/aid94/a494');

        $response->assertStatus(404);
    }




}
