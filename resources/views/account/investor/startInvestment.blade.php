<x-app-layout>
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <div>
                <h1 class="flex-grow-1 fs-3 fw-semibold mb-2">Investir</h1>
                <p class="fw-medium my-0 text-muted">
                    Espace d'investissement.
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
                        @else
                        {{ __('Investisseur') }}
                        @endif
                    </p>
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
                                <h3 class="block-title">Remplissez le formulaire</h3>
                            </div>
                            <div class="block-content pt-0 mt-0">
                                <div class="col-6">
                                    <form action="{{ route('in.store.invest') }}" method="POST">
                                        @csrf
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" id="dm-profile-edit-username" name="lastname" placeholder="" value="{{ Auth::user()->lastname }}" required>
                                            <label class="form-label" for="dm-profile-edit-username">Nom</label>
                                            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" id="dm-profile-edit-name" name="firstname" placeholder="" value="{{ Auth::user()->firstname }}" required>
                                            <label class="form-label" for="dm-profile-edit-name">Prénom(s)</label>
                                            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                                        </div>

                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" id="dm-profile-edit-name" name="project" placeholder="" value="{{ $project->imat }}" required hidden>
                                            
                                        </div>

                                        <div class="login-register__checkbox">
                                            <input type="checkbox" id="login-register__policy" required>
                                            <label for="login-register__policy">J'ai les <a href="#"> règles et politiques d'investissement</a>.</label>
                                        </div>

                                        <div class="login-register__checkbox">
                                            <input type="checkbox" id="login-register__policy" required>
                                            <label for="login-register__policy">J'accepte la <a href="#">politique de confidentialité de {{$project->company->name }}</a>.</label>
                                        </div>

                                        <div class="login-register__checkbox">
                                            <input type="checkbox" id="login-register__policy" required>
                                            <label for="login-register__policy">Je suis conscient des risques d'investissment.</label>
                                        </div>

                                        <div class="login-register__checkbox">
                                            <input type="checkbox" id="login-register__policy" required>
                                            <label for="login-register__policy">J'accepte la <a href="#">politique de confidentialité de monica finance</a>.</label>
                                        </div>

                                        <div class="form-floating mb-4">
                                            <button type="submit" class="btn btn-secondary">
                                                Finaliser l'investissement
                                            </button>
                                        </div>
                                    </form>
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