<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">MyApp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('map') }}">{{ __('navbar.map') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('products') }}">{{ __('navbar.products') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tables') }}">{{ __('navbar.tables') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('userManagment') }}">{{ __('navbar.userManagment') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('lang.switch', 'en') }}">EN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('lang.switch', 'lv') }}">LV</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('navbar.login') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('navbar.register') }}</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
