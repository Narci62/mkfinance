<x-app-layout>
    
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <div>
                <h1 class="flex-grow-1 fs-3 fw-semibold mb-2">Profil</h1>
                <p class="fw-medium my-0 text-muted">
                    Gérez et modifiez les informations de votre profil.
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
                        <div class="col-4 py-3 bg-body-light border-bottom">
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

                        <div class="col-4 py-3">
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
                                <h3 class="block-title">Photo de profil</h3>
                                <p class="mt-1 fs-sm text-gray-300">
                                    Mettez à jour votre photo de profil.
                                </p>
                            </div>
                            <div class="block-content pt-0 mt-0">
                                <div class="col-6">
                                    <form action="{{ route('co.profile.avatar') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="mb-4">
                                            @isset(Auth::user()->avatar)
                                            <label class="form-label">Photo de profil</label>
                                            <div class="push">
                                                <img class="img-avatar" src="{{ Storage::url(auth()->user()->avatar) }}" alt="">
                                            </div>
                                            @endisset

                                            <label class="form-label fs-sm" for="dm-profile-edit-avatar">Choissisez une photo</label>
                                            <input class="form-control form-control-lg" type="file" name="avatar" id="dm-profile-edit-avatar" accept="image/*">
                                            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                                        </div>

                                        <button type="submit" class="btn btn-secondary">
                                            Enregistrer la photo
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
                                <h3 class="block-title">Informations personnelles</h3>
                                <p class="mt-1 fs-sm text-gray-300">
                                    Mettez à jour vos informations personnelles.
                                </p>
                            </div>
                            <div class="block-content pt-0 mt-0">
                                <div class="col-6">
                                    <form action="{{ route('co.profile.perso') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        
                                        {{--<textarea id="myeditorinstance">Hello, World!</textarea> --}}
                                        <div class="form-floating mb-4">
                                            <input type="email" name="email" class="form-control" id="dm-profile-edit-email" value="{{ Auth::user()->email }}" disabled="" required>
                                            <label class="form-label" for="dm-profile-edit-email">Adresse email</label>
                                            @if(!Auth()->user()->hasVerifiedEmail())
                                            <small class="alert fw-bold">{{ __('Email non-validé ') }}<a href="{{ route('verification.notice') }}" class="btn btn-outline-primary btn-sm "> Valider mon email <i class="fa fa-paper-plane fa-sm"></i></a></small>
                                            @endif
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" id="dm-profile-edit-username" name="lastname" placeholder="" value="{{ Auth::user()->lastname }}" disabled>
                                            <label class="form-label" for="dm-profile-edit-username">Nom</label>
                                            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" id="dm-profile-edit-name" name="firstname" placeholder="" value="{{ Auth::user()->firstname }}" disabled>
                                            <label class="form-label" for="dm-profile-edit-name">Prénom(s)</label>
                                            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                                        </div>

                                        <div class="form-floating mb-4">
                                            <input type="tel" name="phone_number" class="form-control" id="phone" placeholder="" value="{{ Auth::user()->phone_number }}">
                                            <label class="form-label" for="dm-profile-edit-email">Numéro de téléphone</label>
                                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
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
                                <h3 class="block-title">Pièce d'identité</h3>
                                <p class="mt-1 fs-sm text-gray-300">
                                    Ajoutez ou mettez à jour votre pièce d'identé.
                                </p>
                            </div>
                            <div class="block-content pt-0 mt-0">
                                <div class="col-6">
                                    <form action="{{ route('co.profile.id') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-floating mb-4">
                                            <select class="form-select" id="idType" name="id_type" aria-label="1" required>
                                                <option>Choisissez une option</option>
                                                <option @if(Auth::user()->id_type AND Auth::user()->id_type == 'passeport') selected @endif value="passeport">{{__('Passeport')}}</option>
                                                <option @if(Auth::user()->id_type AND Auth::user()->id_type == 'cni') selected @endif value="cni">{{__('CNI')}}</option>
                                            </select>
                                            <label class="form-label" for="idType">Type de pièce</label>
                                            <x-input-error :messages="$errors->get('id_type')" class="mt-2" />
                                        </div>

                                        <div id="id_infos" @if(!Auth::user()->id_document) style="display:none;" @endif>
                                            <div class="form-floating mb-4">
                                                <input type="file" class="form-control" id="idDocument" name="id_document" placeholder="">
                                                <label class="form-label" for="idDocument">Importez votre pièce d'identité</label>
                                                @isset(Auth::user()->id_document)
                                                <div class="ms-1 fs-sm">
                                                    <a href="{{ Storage::url(auth()->user()->id_document) }}">{{ Auth::user()->id_type }}.pdf</a>
                                                    <span class="ms-1 fs-sm text-muted fst-italic">({{__('Expire le ')}} {{ __(\Carbon\Carbon::parse(Auth::user()->id_document_exp)->translatedFormat('l j F Y')) }})</span>
                                                </div>
                                                @endisset
                                                <x-input-error :messages="$errors->get('id_document')" class="mt-2" />
                                            </div>

                                            <div class="form-floating mb-4">
                                                <input type="date" name="id_exp" class="form-control" id="idExp" placeholder="">
                                                <label class="form-label" for="idExp">Date d'expiration</label>
                                                <x-input-error :messages="$errors->get('id_exp')" class="mt-2" />
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-secondary">
                                            Uploader
                                        </button>
                                        @if(!Auth::user()->id_document)
                                        <script>
                                            document.getElementById('idType').addEventListener('change', function() {
                                                var idDocInfo = document.getElementById('id_infos');
                                                if (this.value === 'passeport' || this.value === 'cni') {
                                                    idDocInfo.style.display = 'block';
                                                } else {
                                                    idDocInfo.style.display = 'none';
                                                }
                                            });
                                        </script>
                                        @endif
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