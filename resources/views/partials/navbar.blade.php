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
            <a class="nav-link" href="{{ route('map') }}">Map</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('products') }}">Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tables') }}">Tables</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('userManagment') }}">User Managment</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
