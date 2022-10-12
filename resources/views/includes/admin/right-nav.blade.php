<ul class="navbar-nav ml-auto">
    {{-- <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li> --}}
    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-sm btn-dark" role="button">Logout <i class="fas fa-sign-out-alt"></i></button>
        </form>
    </li>
  </ul>
</nav>
