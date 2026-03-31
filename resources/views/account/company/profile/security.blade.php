<x-app-layout>
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <div>
                <h1 class="flex-grow-1 fs-3 fw-semibold mb-2">Sécurité</h1>
                <p class="fw-medium my-0 text-muted">
                    Gérez les paramètres de sécurité de votre compte.
                </p>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row mb-3">
            <div class="col-md-12 m-auto">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
                            <div class="flex-shrink-0">
                                <i class="fa fa-fw fa-exclamation-circle fa-sm"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0">{{ __($error) }}</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
    
                @if (session('error'))
                    <div class="alert alert-danger">
                        {!! session('error') !!}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
                        <div class="flex-shrink-0">
                            <i class="fa fa-fw fa-check fa-sm"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-0">{{ __(session('success')) }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="block block-rounded">
            <div class="block-content text-center">
                <div class="py-4">
                    <div class="mb-3">
                        @if(Auth::user()->avatar)
                            <img class="img-avatar img-avatar96" src="{{ Storage::url(auth()->user()->avatar) }}" alt="">
                        @else
                            <img class="img-avatar img-avatar96" src="{{asset('media/avatars/avatar15.jpg') }}" alt="">
                        @endif
                    </div>
                    <h1 class="fs-lg mb-0"> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} </h1>
                    <p class="text-muted">
                    <i class="fa fa-award text-warning me-1"></i>
                        @if(Auth::user()->account_type == "company" AND isset(Auth::user()->company))
                        {{ Auth::user()->company->name }}
                        @endif
                    </p>
                </div>
            </div>
            <div class="block-content+ m-0 p-0 text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-4 py-3">
                            <a class="text-center" href="{{ route('co.profile') }}">
                                <div class="fs-5 fw-semibold mb-1">
                                    <i class="fa fa-pencil-alt text-dark"></i>
                                </div>
                                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                                    Profil
                                </p>
                            </a>
                        </div>
    
                        <div class="col-4 py-3">
                            <a class="text-center" href="{{ route('co.preferences') }}">
                                <div class="fs-5 fw-semibold mb-1">
                                    <i class="fa fa-cog text-dark"></i>
                                </div>
                                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                                    Préférences
                                </p>
                            </a>
                        </div>

                        <div class="col-4 py-3 bg-body-light border-bottom">
                            <a class="text-center" href="{{ route('co.security') }}">
                                <div class="fs-5 fw-semibold mb-1">
                                    <i class="fa fa-lock text-dark"></i>
                                </div>
                                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                                    Sécurité
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(Auth::check())
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="block block-rounded">
                                <div class="block-header d-block pb-0 mb-0">
                                    <h3 class="block-title">Changer le mot de passe</h3>
                                    <p class="mt-1 fs-sm text-gray-300">
                                        Mettez à jour votre mot de passe.
                                    </p>
                                </div>
                                <div class="block-content pt-0 mt-0">
                                    <div class="col-6">
                                        <form action="{{ route('password.update') }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="form-floating mb-4">
                                                <input type="password" name="current_password" class="form-control" id="dm-profile-edit-current-password" value="" required>
                                                <label class="form-label" for="dm-profile-edit-current-password">Mot de passe actuel</label>
                                                <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                                            </div>
                                            <div class="form-floating mb-4">
                                                <input type="password" class="form-control" id="dm-profile-edit-new-password" name="password" placeholder="" value="" required>
                                                <label class="form-label" for="dm-profile-edit-new-password">Nouveau mot de passe</label>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                            <div class="form-floating mb-4">
                                                <input type="password" class="form-control" id="dm-profile-edit-password-confirmation" name="password_confirmation" placeholder="" value="" required>
                                                <label class="form-label" for="dm-profile-edit-password-confirmation">Confirmez nouveau mot de passe</label>
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                            </div>
                                            
                                            <button type="submit" class="btn btn-secondary">
                                                Enregistrer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block block-rounded">
                <div class="block-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="block block-rounded">
                                <div class="block-header d-block pb-0 mb-0">
                                    <h3 class="block-title">Suppression de compte</h3>
                                    <p class="mt-1 fs-sm text-gray-300">
                                        Les administrateurs prendront en compte votre demande et procederont à la suppression progressive de votre compte dans les 20 jours qui suivent.
                                    </p>
                                </div>
                                <div class="block-content pt-0 mt-0">
                                    <div class="col-6">
                                        @if(Auth::user()->account_del == 0)
                                        <form action="{{ route('co.profile.delete') }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-danger">
                                                Supprimer mon compte
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('co.profile.canceldelete') }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-warning">
                                                Annuler la suppression
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        @endif
    </div>
</x-app-layout>