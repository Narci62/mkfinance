<x-app-layout>

    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <div>
                <h1 class="flex-grow-1 fs-3 fw-semibold mb-2">{{ __('Ajouter votre entreprise') }}</h1>
                <p class="fw-medium my-0 text-muted">
                    {{ __('Renseignez les details de votre entreprise ou startup.') }}
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
        {{--
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
    --}}

    @if(Auth::check())

    @if ($step_config <=1)
        <div class="block block-rounded">
        <div class="block-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="block block-rounded">
                        <div class="block-header d-block pb-0 mb-0">
                            <h3 class="block-title">{{ __('Informaition de base') }}</h3>
                        </div>
                        <div class="block-content pt-0 mt-0">
                            <div class="col-6">
                                <form method="POST" action="{{ route('wizard.config1') }}">
                                    @csrf

                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" id="company_name_field" name="company_name" placeholder="Nom de l'entreprise" required autofocus>
                                        <label class="form-label" for="company_name_field">Nom de l'entreprise</label>
                                        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                                    </div>

                                    <div class="form-floating mb-4">
                                        <select class="form-select" id="company_sector_filed" name="company_sector" aria-label="Secteur A" required>
                                            <option selected>Choisissez un secteur</option>
                                            @foreach($sectors as $sector)
                                            <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                                            @endforeach
                                            <option value="other">Autres</option>
                                        </select>
                                        <label class="form-label" for="company_sector_filed">Secteur d'activité</label>
                                        <x-input-error :messages="$errors->get('company_sector')" class="mt-2" />
                                    </div>
                                    <div class="form-floating mb-4" id="company_other_sector_field" style="display:none;">
                                        <input type="text" class="form-control" id="company_other_sector_field" name="company_other_sector" placeholder="Autre secteur">
                                        <label class="form-label" for="company_other_sector_field">Précisez le secteur</label>
                                        <x-input-error :messages="$errors->get('other_sector')" class="mt-2" />
                                    </div>
                                    <div class="form-floating mb-4">
                                        <select class="form-select" id="company_staff_number" name="company_staff_number" aria-label="1" required>
                                            <option>Choisissez une option</option>
                                            <option value="<5">{{__('<5')}}</option>
                                            <option value="10+">{{__('10+')}}</option>
                                            <option value="50+">{{__('50+')}}</option>
                                            <option value="100+">{{__('100+')}}</option>
                                            <option value="500+">{{__('500+')}}</option>
                                            <option value="1000+">{{__('1000+')}}</option>
                                        </select>
                                        <label class="form-label" for="company_staff_number">Nombre d'employés</label>
                                        <x-input-error :messages="$errors->get('company_staff_number')" class="mt-2" />
                                    </div>

                                    <div class="form-floating mb-4">
                                        <select class="form-select" id="company_yearly_income" name="company_yearly_income" aria-label="Secteur A" required>
                                            <option>Choisissez une option</option>
                                            <option value="<1000000">
                                                <{{number_format(1000000, 2, ',','.')}}</option>
                                            <option value="5000000+">{{number_format(5000000, 2, ',','.')}}+</option>
                                            <option value="10000000+">{{number_format(10000000, 2, ',','.')}}+</option>
                                        </select>
                                        <label class="form-label" for="company_yearly_income">Chiffre d'affaire annuel</label>
                                        <x-input-error :messages="$errors->get('company_yearly_income')" class="mt-2" />
                                    </div>

                                    <div class="form-floating mb-4">
                                        <textarea class="form-control" maxlength="1000" id="company_overview_intro_field" name="company_overview_intro" style="height: 150px" placeholder="Décrivez votre votre entreprise en quelques lignes" required></textarea>
                                        <label class="form-label" for="company_overview_intro_field">A propos de l'entreprise</label>
                                        <x-input-error :messages="$errors->get('company_overview_intro')" class="mt-2" />
                                    </div>

                                    <div class="text-start">
                                        <button type="submit" class="btn btn-md btn-outline-secondary"> {{ __('Poursuivre') }} <i class="si si-arrow-right"></i></button>
                                    </div>

                                    <script>
                                        document.getElementById('company_sector_filed').addEventListener('change', function() {
                                            var otherField = document.getElementById('company_other_sector_field');
                                            if (this.value === '1') {
                                                otherField.style.display = 'block';
                                            } else {
                                                otherField.style.display = 'none';
                                            }
                                        });
                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        @endif

        @if ($step_config ==2)
        <div class="block block-rounded">
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block block-rounded">
                            <div class="block-header d-block pb-0 mb-0">
                                <h3 class="block-title">{{ __('Coordonnées de l\'entreprise') }}</h3>
                            </div>
                            <div class="block-content pt-0 mt-0">
                                <div class="col-6">
                                    <form method="POST" action="{{ route('wizard.config2') }}">
                                        @csrf
                                        <div class="form-floating mb-4">
                                            <input type="email" class="form-control" id="company_email_field" name="company_email" placeholder="Adresse email de l'entreprise" required autofocus>
                                            <label class="form-label" for="company_email_field">Adresse email</label>
                                            <x-input-error :messages="$errors->get('company_email')" class="mt-2" />
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" id="company_phone_number_field" name="company_phone_number" placeholder="Numéros de téléphone de l'entreprise" required autofocus>
                                            <label class="form-label" for="company_phone_number_field">Numéros de téléphone</label>
                                            <span class="text-muted fs-sm fst-italic">Veuillez séparer vos numéros par : /</span>
                                            <x-input-error :messages="$errors->get('company_phone_number')" class="mt-2" />
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="url" class="form-control" id="company_website_field" name="company_website" placeholder="Site web de l'entreprise" required autofocus>
                                            <label class="form-label" for="company_website_field">Site web</label>
                                            <span class="text-muted fs-sm fst-italic">Veuillez respecter le format suivant : https://example.com</span>
                                            <x-input-error :messages="$errors->get('company_website')" class="mt-2" />
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" id="company_adresse_field" name="company_adresse" placeholder="Adresse géographique" required autofocus>
                                            <label class="form-label" for="company_adresse_field">Adresse géographique de l'entreprise</label>
                                            <x-input-error :messages="$errors->get('company_adresse')" class="mt-2" />
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-md btn-outline-primary"> {{ __('Poursuivre') }} <i class="si si-arrow-right"></i></button>
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

        @if ($step_config ==3)
        <div class="block block-rounded">
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="block block-rounded">
                            <div class="block-header d-block pb-0 mb-0">
                                <h3 class="block-title">{{ __('Documents de votre entreprise') }}</h3>
                            </div>
                            <div class="block-content pt-0 mt-0">
                                <div class="col-6">
                                    <form method="POST" action="{{ route('wizard.config3') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-4">
                                            <input type="file" class="form-control form-control-alt form-control-lg" id="company_logo_field" name="company_logo" required accept="image/png, image/jpeg">
                                            <label class="form-label" for="company_logo_field">Logo</label>
                                            <span class="text-muted fs-sm fst-italic">Taille maximale exigée : 2Mo</span>
                                            <x-input-error :messages="$errors->get('company_logo')" class="mt-2" />
                                        </div>
                                        <div class="mb-4">
                                            <input type="file" class="form-control form-control-alt form-control-lg" id="company_rccm_field" name="company_rccm" required accept="application/pdf">
                                            <label class="form-label" for="company_rccm_field">RCCM</label>
                                            <span class="text-muted fs-sm fst-italic">Taille maximale exigée : 2Mo; Format : pdf</span>
                                            <x-input-error :messages="$errors->get('company_rccm')" class="mt-2" />
                                        </div>
                                        <div class="mb-4">
                                            <input type="file" class="form-control form-control-alt form-control-lg" id="company_ifu_field" name="company_ifu" required accept="application/pdf">
                                            <label class="form-label" for="company_ifu_field">IFU</label>
                                            <span class="text-muted fs-sm fst-italic">Taille maximale exigée : 2Mo; Format : pdf</span>
                                            <x-input-error :messages="$errors->get('company_ifu')" class="mt-2" />
                                        </div>
                                        <div class="mb-4">
                                            <input type="file" class="form-control form-control-alt form-control-lg" id="company_atf_field" name="company_atf" required accept="application/pdf">
                                            <label class="form-label" for="company_atf_field">Attestation fiscal</label>
                                            <span class="text-muted fs-sm fst-italic">Taille maximale exigée : 2Mo; Format : pdf</span>
                                            <x-input-error :messages="$errors->get('company_atf')" class="mt-2" />
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-md btn-outline-primary"> {{ __('Accéder à mon compte') }} <i class="si si-arrow-right"></i></button>
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


        @endif
        </div>

</x-app-layout>