
<h3 class="text-muted">Title : {{ $page->title }}</h3>

<p><b>Content :</b> {{ $page->content }}</p>

@if(count($page->pages) > 0)
    <h5>Pages:</h5>
    @foreach($page->pages as $page)
        <div class="list-group list-group-flush">
            <a href="/{{ $page->page_slug }}" class="list-group-item list-group-item-action">{{ $page->title }}</a>
        </div>
    @endforeach
@endif