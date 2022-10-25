<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\PageService;

class Pages extends Component
{
    public $title;
    public $content;
    public $parent_id;
    public $page_id;
    public $updateMode = false;
    private $pageService;

    public function boot(PageService $service)
    {
        $this->pageService = $service;
    }


    public function render()
    {
        return view('livewire.pages',[
            'all_pages' => $this->pageService->getPages()
        ]);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->title = '';
        $this->content = '';
        $this->parent_id = '';
    }

    protected $rules = [
        'title' => 'required|max:255',
        'content'=> 'required',
        'parent_id' => 'required|exists:pages,id'
    ];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        try{
            $page = $this->pageService->edit($id);
            $this->page_id = $id;
            $this->title = $page->title;
            $this->content = $page->content;
            $this->parent_id = $page->parent_id;

            $this->updateMode = true;
        } catch (\Exception $e) {
            $this->addError('error', 'Unable to delete.');
        };
    }

    public function store()
    {
        $this->validate();

        $this->pageService->add($this->title,$this->content,$this->parent_id);

        session()->flash('message', 'Page Created Successfully.');

        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
        $this->resetValidation();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function update()
    {
        $this->validate();

        try{
            $this->pageService->update($this->page_id, $this->title,$this->content,$this->parent_id);

            $this->updateMode = false;

            session()->flash('message', 'Page Updated Successfully.');

            $this->resetInputFields();
        } catch (\Exception $e) {
            $this->addError('error', 'Unable to update.');
        };

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        try{

            $this->pageService->remove($id);

            session()->flash('message   ', 'Page Deleted Successfully.');
        } catch (\Exception $e) {
            $this->addError('error', 'Unable to delete.');
        };

    }
}
