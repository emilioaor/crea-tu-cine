<nav id="-panel">
    <div class="container-fluid">
        <ul>
            <li><a href="{{ route('cine.user.index', ['user' => $userUrl]) }}">Cine <span class="fa fa-film"></span></a></li>
            <li><a href="{{ route('cine.user.movies.create', ['user' => $userUrl]) }}">Agregar <span class="fa fa-plus"></span></a></li>
            <li><a href="{{ route('cine.user.movies.index', ['user' => $userUrl]) }}">Lista <span class="fa fa-list"></span></a></li>
            <li><a href="{{ route('cine.user.relation.index', ['user' => $userUrl]) }}">Relaciones <span class="fa fa-random"></span></a></li>
            <li><a href="{{ route('cine.user.config', ['user' => $userUrl]) }}">Config <span class="fa fa-cog"></span></a></li>
            <li><a href="{{ route('cine.user.share', ['user' => $userUrl]) }}">Compartir <span class="fa fa-link"></span></a></li>
        </ul>
    </div>
</nav>