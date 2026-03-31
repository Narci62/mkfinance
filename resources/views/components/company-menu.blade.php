<nav id="sidebar" aria-label="Main Navigation">
    <div class="smini-visible-block">
        <div class="content-header ps-2 bg-black-10">
            <a class="fw-semibold text-white" href="{{ route('co') }}">
                <img src="{{ asset('media/brand/monicafinance_logo_sm.png') }}" width="40" alt="">
                <!-- M<span class="opacity-75">f</span> -->
            </a>
        </div>
    </div>

    <div class="smini-hidden">
        <div class="content-header justify-content-lg-start bg-black-10">
            <a class="fw-semibold text-white tracking-wide" href="{{ route('co') }}">
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
        <div class="content-side pt-4">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->routeIs('co') ? 'active' : '' }}" href="{{ route('co') }}">
                        <i class="nav-main-link-icon fa fa-display"></i>
                        <span class="nav-main-link-name">{{ __('Tableau de board') }}</span>
                        {{-- <span class="nav-main-link-badge badge rounded-pill bg-success">3</span> --}}
                    </a>
                </li>

                
                <li class="nav-main-heading">{{Auth::user()->company?->name}}</li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->routeIs('co.overview') ? 'active' : '' }}" href="{{ route('co.overview') }}">
                        <i class="nav-main-link-icon fa fa-fw fa-building"></i>
                        <span class="nav-main-link-name">{{ __('Apperçu') }}</span>
                    </a>
                </li>
                
                
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('wizard.config1') }}">
                        <i class="nav-main-link-icon fa fa-fw fa-building"></i>
                        <span class="nav-main-link-name">{{ __('Mon entreprise') }}</span>
                    </a>
                </li>
                {{-- si le project est rediger --}}
                
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('co.investors') }}">
                        <i class="nav-main-link-icon fa fa-fw fa-dollar"></i>
                        <span class="nav-main-link-name">{{ __('Investisseurs') }}</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('co.wallet') }}">
                        <i class="nav-main-link-icon fa fa-wallet"></i>
                        <span class="nav-main-link-name">{{ __('Portefeuille') }}</span>
                    </a>
                </li>


                <li class="nav-main-heading">{{ __('Blog') }}</li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('co.posts') }}">
                        <i class="nav-main-link-icon fab fa-readme"></i>
                        <span class="nav-main-link-name">{{ __('Mes articles') }}</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('co.newpost') }}">
                        <i class="nav-main-link-icon fa fa-plus"></i>
                        <span class="nav-main-link-name">{{ __('Nouvel article') }}</span>
                    </a>
                </li>
                

                <li class="nav-main-heading">{{ __('Compte') }}</li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->routeIs('co.profile') ? 'active' : '' }}" href="{{ route('co.profile') }}">
                        <i class="nav-main-link-icon fa fa-user"></i>
                        <span class="nav-main-link-name">{{ __('Profil') }}</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->routeIs('co.preferences') ? 'active' : '' }}" href="{{ route('co.preferences') }}">
                        <i class="nav-main-link-icon fa fa-cog"></i>
                        <span class="nav-main-link-name">{{ __('Préférences') }}</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->routeIs('co.security') ? 'active' : '' }}" href="{{ route('co.security') }}">
                        <i class="nav-main-link-icon fa fa-lock"></i>
                        <span class="nav-main-link-name">{{ __('Sécurité') }}</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="d-inline-block text-start btn nav-main-link" style="width: 100%">
                            <i class="nav-main-link-icon fa fa-fw fa-arrow-alt-circle-left me-1"></i> {{ __('Déconnexion') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>