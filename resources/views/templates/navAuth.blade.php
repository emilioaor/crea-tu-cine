<!-- Navigation -->
<nav class="navbar fixed-top navbar-toggleable-md navbar-light" id="mainNav">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
        <a class="navbar-brand" href="{{ route('cine.all') }}">Taquilla</a>
        <div class="collapse navbar-collapse" id="navbarExample">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cine.user.index', ['user' => Auth::user()->user]) }}">Volver a mi Cinema</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index.logout') }}">Salir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>