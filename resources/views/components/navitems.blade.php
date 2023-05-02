<ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdownMenuCadastros" role="button"
           data-bs-toggle="dropdown" aria-expanded="false">
            Cadastros
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuCadastros">
            <li><a class="dropdown-item" href="{{ route('portfolios.index') }}">Carteiras</a></li>
            <li><a class="dropdown-item" href="{{ route('investors.index') }}">Investidores</a></li>
            <li><a class="dropdown-item" href="{{ route('custodians.index') }}">Corretoras</a></li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white fw-bold" href="{{ route('about') }}">
            <i class="fa-solid fa-circle-info fa-lg"></i>
            <span class="ms-1">Sobre</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdownMenuUser" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <span class="ms-1">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUser">
            <li><a class="dropdown-item" href="{{ route('users.account') }}">Conta</a></li>
            @can('manage-users')
                <li><a class="dropdown-item" href="{{ route('users.approve') }}">Aprovar Usuários</a></li>
                <li><a class="dropdown-item" href="{{ route('permissions.index') }}">Gerenciar Permissões</a></li>
            @endcan
            <li><a class="dropdown-item" href="{{ route('password.change') }}">Mudar Senha</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item d-flex justify-content-between">
                        Sair
                        <i class="fa-solid fa-circle-xmark"></i>
                    </button>
                </form>
            </li>
        </ul>
    </li>
</ul>
