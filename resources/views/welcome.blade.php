@extends('layouts.app')

@section('content')

<div class="col-sm-12">
    @foreach($pages as $page)
        <div class="card p-4">

          @include('components.page', ['pages' => $page->pages])

        </div>
    @endforeach
</div>
@endsection
