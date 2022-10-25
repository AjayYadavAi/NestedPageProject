<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PageService;

class PageController extends Controller
{
    private $pageService;

    public function __construct(PageService $service){
        $this->pageService = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('welcome',[
            'pages'     => $this->pageService->getDefaultPage()
        ]);
    }
    public function index()
    {
        return view('pages');
    }


    public function show($slug)
    {
        try{
            $page = $this->pageService->getSinglePage($slug);
            if($page->page_slug != $slug){
                abort(404);
            }
            return view('view',[ 'page'=>$page ]);
        } catch (\Exception $e) {
            abort(404);
        };
    }
}
