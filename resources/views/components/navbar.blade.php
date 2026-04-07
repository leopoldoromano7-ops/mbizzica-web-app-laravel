@php
  $links = [
      ['label' => 'Home', 'route' => 'homepage'],
      ['label' => 'Archive', 'route' => 'pastes.index'],
      ['label' => 'New Paste', 'route' => 'pastes.create'],
  ];
@endphp

<nav class="navbar navbar-expand-lg site-navbar">
  <div class="container-fluid shell-container">
    <a class="navbar-brand site-brand" href="{{ route('homepage') }}">
      <span class="brand-mark">
        <img src="{{ asset('favicon.svg') }}" alt="Mbizzica logo">
      </span>
      <span class="brand-copy">
        <span class="brand-title">mbizzica</span>
        <span class="brand-subtitle">paste workspace</span>
      </span>
    </a>

    <button class="navbar-toggler navbar-toggler-custom" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav nav-shell me-auto">
        @foreach ($links as $link)
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs($link['route']) ? 'is-active' : '' }}" href="{{ route($link['route']) }}">
              {{ $link['label'] }}
            </a>
          </li>
        @endforeach
      </ul>

      <div class="navbar-auth">
        @auth
          <div class="dropdown">
            <button class="btn auth-chip dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end dropdown-surface">
              <li><a class="dropdown-item" href="{{ route('settings.two-factor') }}">Impostazioni</a></li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </div>
        @else
          <a class="btn btn-ghost" href="{{ route('login') }}">Login</a>
          <a class="btn btn-neon" href="{{ route('register') }}">Sign up</a>
        @endauth
      </div>
    </div>
  </div>
</nav>
