<nav id="sidebar" aria-label="Main Navigation">
    <div class="smini-visible-block">
        <div class="content-header ps-2 bg-black-10">
            <a class="fw-semibold text-white" href="{{ route('in') }}">
            <img src="{{ asset('media/brand/monicafinance_logo_sm.png') }}" width="40" alt="">
            <!-- M<span class="opacity-75">f</span> -->
            </a>
        </div>
    </div>

    <div class="smini-hidden">
        <div class="content-header justify-content-lg-start bg-black-10">
            <a class="fw-semibold text-white tracking-wide" href="{{ route('in') }}">
                <img src="{{ asset('media/brand/monicafinance_logo_light.png') }}" width="130" alt="">
            <!-- Monica <span class="fw-normal">Finance</span> -->
            </a>

            <div class="d-lg-none">
            <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout" data-action="sidebar_close">
                <i class="fa fa-times-circle"></i>
            </button>
            </div>
        </div>
    </div>

    <div class="js-sidebar-scroll">

        <!-- Side Navigation -->
        <div class="content-side pt-1">
            <ul class="nav-main">
                <li class="nav-main-heading">Accueil</li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('admin') }}">
                    <i class="nav-main-link-icon fa fa-display"></i>
                    <span class="nav-main-link-name">Tableau de board</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('in.wallet') }}">
                    <i class="nav-main-link-icon fa fa-wallet"></i>
                    <span class="nav-main-link-name">Company</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('in.wallet') }}">
                    <i class="nav-main-link-icon fa fa-wallet"></i>
                    <span class="nav-main-link-name">Investisseur</span>
                    </a>
                </li>

                <li class="nav-main-heading">Paramètres</li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('in.profile') }}">
                    <i class="nav-main-link-icon fa fa-bell"></i>
                    <span class="nav-main-link-name">Notifications</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('in.profile') }}">
                    <i class="nav-main-link-icon fa fa-credit-card"></i>
                    <span class="nav-main-link-name">Transactions</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('in.profile') }}">
                    <i class="nav-main-link-icon fa fa-language"></i>
                    <span class="nav-main-link-name">Langues</span>
                    </a>
                </li>
                


                <li class="nav-main-heading">Compte</li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('in.profile') }}">
                    <i class="nav-main-link-icon fa fa-user"></i>
                    <span class="nav-main-link-name">Mon Profil</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="d-inline-block text-start btn nav-main-link" style="width: 100%">
                            <i class="nav-main-link-icon fa fa-fw fa-arrow-alt-circle-left me-1"></i> Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>