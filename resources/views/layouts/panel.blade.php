<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | Serenity Spa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@php
  $isAdmin = auth()->user()->isAdmin();
  $menu = $isAdmin ? [
    ['Main', null],
    ['Dashboard', 'admin.dashboard', 'bi-speedometer2'],
    ['Management', null],
    ['Customers', 'admin.customers.*', 'bi-people', 'admin.customers.index'],
    ['Treatments', 'admin.treatments.*', 'bi-droplet-half', 'admin.treatments.index'],
    ['Therapists', 'admin.therapists.*', 'bi-person-heart', 'admin.therapists.index'],
    ['Bookings', 'admin.bookings.*', 'bi-calendar2-check', 'admin.bookings.index'],
  ] : [
    ['Explore', null],
    ['Home', 'user.home', 'bi-house-heart'],
    ['My Account', null],
    ['Book Treatment', 'user.bookings.create', 'bi-plus-circle'],
    ['My Bookings', 'user.bookings.index', 'bi-calendar2-heart'],
    ['Profile', 'user.profile*', 'bi-person-gear', 'user.profile'],
  ];
@endphp

<aside class="sidebar" id="sidebar">
  <a href="{{ route($isAdmin ? 'admin.dashboard' : 'user.home') }}" class="brand">
    <span class="logo"><i class="bi bi-flower1"></i></span>
    <span><b>Serenity Spa</b><small>{{ $isAdmin ? 'Admin Panel' : 'Customer Panel' }}</small></span>
  </a>

  <nav class="menu">
    @foreach($menu as $i => $m)
      @if($m[1] === null)
        <div class="nav-label">{{ $m[0] }}</div>
      @else
        @php $target = $m[3] ?? $m[1]; @endphp
        <a href="{{ route($target) }}" class="{{ request()->routeIs($m[1]) ? 'active' : '' }}" style="animation-delay: {{ $i * .05 }}s">
          <i class="bi {{ $m[2] }}"></i> {{ $m[0] }}
        </a>
      @endif
    @endforeach
  </nav>

  <div class="profile-box">
    <div class="who">
      <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
      <div><b>{{ auth()->user()->name }}</b><small>{{ auth()->user()->role }}</small></div>
    </div>
    <form method="POST" action="{{ route('logout') }}">@csrf
      <button class="logout-btn"><i class="bi bi-box-arrow-left me-1"></i> Logout</button>
    </form>
  </div>
</aside>
<div class="overlay" id="overlay"></div>

<div class="main">
  <header class="topbar">
    <button class="menu-toggle" id="menuToggle"><i class="bi bi-list"></i></button>
    <div>
      <h1>@yield('title')</h1>
      <div class="crumb">{{ $isAdmin ? 'Admin' : 'User' }} / @yield('title')</div>
    </div>
    <div class="ms-auto text-muted small d-none d-md-block"><i class="bi bi-calendar3 me-1"></i>{{ now()->format('D, d M Y') }}</div>
  </header>

  <main class="content">
    @if(session('success')) <div class="flash ok mb-4"><i class="bi bi-check-circle-fill"></i>{{ session('success') }}</div> @endif
    @if(session('error'))   <div class="flash err mb-4"><i class="bi bi-exclamation-triangle-fill"></i>{{ session('error') }}</div> @endif
    @yield('content')
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const sb = document.getElementById('sidebar');
  document.getElementById('menuToggle').onclick = () => sb.classList.toggle('open');
  document.getElementById('overlay').onclick = () => sb.classList.remove('open');
</script>
@stack('scripts')
</body>
</html>
