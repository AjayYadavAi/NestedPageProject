<!DOCTYPE html>
<html lang="en">
<head>
  <title>CMS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  @livewireStyles
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="/">Home</a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a href="{{ route('pages.index')}}" class="nav-link">Page (CRUD)</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
    <div class="pt-3">

        @yield('content')

    </div>
</div>

@livewireScripts
</body>
</html>
