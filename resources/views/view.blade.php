@extends('layouts.app')

@section('content')
<div class="col-sm-8">
    <div class="card p-4">

      @include('components.page', ['pages' => $page->pages])

    </div>
</div>
@endsection