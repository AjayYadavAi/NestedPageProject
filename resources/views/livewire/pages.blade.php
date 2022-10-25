<div class="row">
    <div class="col-sm-8">
      <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Id.</th>
                <th>Title</th>
                <th>Parent page</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($all_pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->title }}</td>
                <td>{{ $page->parent->title ?? 'default page' }}</td>
                <td>
                  @if($page->parent_id != 0)
                <button wire:click="edit({{ $page->id }})" class="btn btn-primary btn-sm">Edit</button>
                    <button wire:click="delete({{ $page->id }})" class="btn btn-danger btn-sm">Delete</button>
                  @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <div class="col-sm-4">

      @if (session()->has('message'))
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
      @endif

      @if (session()->has('error'))
          <div class="alert alert-danger">
              {{ session('message') }}
          </div>
      @endif

      @if($updateMode)
        @include('livewire.update')
    @else
        @include('livewire.create')
    @endif
  </div>
</div>
