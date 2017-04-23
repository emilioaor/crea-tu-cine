<nav id="-panel">
    <div class="container-fluid">
        <ul>
            <li><a href="{{ route('cine.user.index', ['user' => $userUrl]) }}">Cine <span class="fa fa-film"></span></a></li>
            <li><a href="{{ route('cine.user.share', ['user' => $userUrl]) }}">Compartir <span class="fa fa-link"></span></a></li>
            @if(! Auth::check())
                <li><a href="{{ route('index.index') }}#contact">Crea tu cine <span class="fa fa-film"></span></a></li>
            @endif
        </ul>
    </div>
</nav>