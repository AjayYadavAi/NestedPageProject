<div>
    <form>
      <input type="hidden" wire:model="page_id">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text"
            class="form-control" id="title" aria-describedby="title" placeholder="Title"  wire:model.lazy="title">
        </div>
        @error('title') <span class="text-sm text-danger">{{ $message }}</span> @enderror

        <div class="form-group">
          <label for="content">Content</label>
          <textarea class="form-control" id="content" rows="4"  wire:model.lazy="content"></textarea>
        </div>
        @error('content') <span class="text-sm text-danger">{{ $message }}</span> @enderror


        <div class="form-group">
          <label for="parent_id">Parent Page</label>
          <select class="form-control" id="parent_id" wire:model.lazy="parent_id">
            <option disable>Please select parent Page</option>
             @foreach($all_pages as $page)
              @if($page->id != $page_id)
                <option value="{{ $page->id }}">{{ $page->title }}</option>
              @endif
            @endforeach
          </select>
        </div>
        @error('parent_id') <span class="text-sm text-danger">{{ $message }}</span> @enderror

        <div class="form-group mt-4">
          <button wire:click.prevent="update()" class="btn btn-dark">Update</button>
          <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
        </div>
    </form>
</div>
