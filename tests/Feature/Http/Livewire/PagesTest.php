<?php

namespace Tests\Feature\Http\Livewire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Page;
use Livewire\Livewire;
use App\Http\Livewire\Pages;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test  */
    function it_can_create_page()
    {
        Livewire::test(Pages::class)
            ->set('title', 'page1')
            ->set('content', 'page1 page content')
            ->set('parent_id', 1)
            ->call('store');
        $this->assertTrue(Page::whereTitle('page1')->exists());
    }

    /** @test  */
    function title_is_required()
    {
        Livewire::test(Pages::class)
            ->set('title', '')
            ->call('store')
            ->assertHasErrors([
                'title' => 'required',
                'content' => 'required',
                'parent_id' => 'required'
            ]);
    }

    /** @test  */
    function parent_id_should_be_page_id()
    {
        Livewire::test(Pages::class)
            ->set('parent_id', 4)
            ->call('store')
            ->assertHasErrors(['parent_id' => 'exists']);
    }

    /** @test  */
    function page_show_list_of_all_pages()
    {
        $this->get('/pages')->assertSee('Title');
    }

    /** @test  */
    function edit_page()
    {
        $page = Page::create(['title'=>"page1",'content'=>'page1','parent_id'=>1]);

        Livewire::test(Pages::class)
            ->call('edit',$page->id)
            ->assertSee($page->title);
    }

    /** @test  */
    function default_page_cannot_edit()
    {
        $page = Page::defaultPage()->first();

        Livewire::test(Pages::class)
            ->call('edit',$page->id)
            ->assertHasErrors('error');
    }

    /** @test  */
    function update_page()
    {
        $page = Page::create(['title'=>"page1",'content'=>'page1','parent_id'=>1]);

        Livewire::test(Pages::class)
            ->set('title','page2')
            ->set('content',$page->content)
            ->set('parent_id',$page->parent_id)
            ->set('page_id',$page->id)
            ->call('update')
            ->assertSee('page2');
    }



    /** @test  */
    function default_page_connot_update()
    {
        $page = Page::defaultPage()->first();

        Livewire::test(Pages::class)
            ->set('title','page2')
            ->set('content',$page->content)
            ->set('parent_id',$page->parent_id)
            ->set('page_id',$page->id)
            ->call('update')
            ->assertHasErrors('parent_id')
            ->assertDontSee('page2');
    }

    /** @test  */
    function delete_page()
    {
        $page = Page::create(['title'=>"page1",'content'=>'page1','parent_id'=>1]);

        Livewire::test(Pages::class)
            ->call('delete',$page->id)
            ->assertDontSee($page->title);
    }

    /** @test  */
    function default_page_connot_delete()
    {
        $page = Page::defaultPage()->first();

        Livewire::test(Pages::class)
            ->call('delete',$page->id)
            ->assertHasErrors('error');
    }

    /** @test  */
    function page_creation_contains_livewire_component()
    {
        $this->get('/pages')->assertSeeLivewire('pages');
    }
}
