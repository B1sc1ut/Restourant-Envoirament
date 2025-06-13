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
            <a class="nav-link" href="{{ route('login') }}">{{ __('navbar.login') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('navbar.register') }}</a>
        </li>
        <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-uppercase" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ app()->getLocale() }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        @foreach (['en' => 'English', 'lv' => 'Latviešu'] as $lang => $language)
                            @if ($lang !== app()->getLocale())
                                <li>
                                    <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                                        {{ $language }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
      </ul>
    </div>
  </div>
</nav>
