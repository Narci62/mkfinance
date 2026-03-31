<x-app-layout>

    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <div>
                <h1 class="flex-grow-1 fs-3 fw-semibold mb-2">{{ __('Présentation de projet') }}</h1>
                <p class="fw-medium my-0 text-muted">
                    {{ __('Présenter votre project afin d\'attirer beaucoup d\'investisseurs.') }}
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
                            <a class="text-center" href="{{ route('co.project1') }}">
                                <div class="fs-5 fw-semibold mb-1">
                                    <i class="fa fa-pencil-alt text-dark"></i>
                                </div>
                                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                                    {{ __('Information de base') }}
                                </p>
                            </a>
                        </div>

                        <div class="col-4 py-3 bg-body-light border-bottom">
                            <a class="text-center" href="{{ route('co.project2') }}">
                                <div class="fs-5 fw-semibold mb-1">
                                    <i class="fa fa-cog text-dark"></i>
                                </div>
                                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                                    {{ __('Plan d\'investissement')}}
                                </p>
                            </a>
                        </div>

                        <div class="col-4 py-3">
                            <a class="text-center" href="{{ route('co.project3') }}">
                                <div class="fs-5 fw-semibold mb-1">
                                    <i class="fa fa-lock text-dark"></i>
                                </div>
                                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                                    {{ __('Retour sur investissement') }}
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
                    @if( is_object($plan) && in_array($plan->status,["waiting","validated"]))
                    <div class="text-start">
                        <h4 class="alert alert-warning">{{ __('Vos informations sont en cours de validation.')  }}</h4>
                    </div>
                    @endif
                        <div class="block block-rounded">
                            <div class="block-header d-block pb-0 mb-0">
                                <h3 class="block-title">{{ __('Plan d\'investissement') }}</h3>
                                <p>Veuillez fournir les documents ci-dessous</p>
                            </div>
                            <div class="block-content pt-0 mt-0">
                                <div class="col-6">
                                    <form method="POST" action="{{ route('co.project2') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-4">
                                            <input type="file" class="form-control form-control-alt form-control-lg" id="fundUsage_field" name="fundUsage" accept="application/pdf">
                                            <label class="form-label" for="fundUsage_field">Detail de l'utilisation des fonds</label>
                                            <span class="text-muted fs-sm fst-italic">Taille maximale exigée : 2Mo; Format : pdf</span>

                                            @if( is_object($plan))
                                            <div class="ms-1 fs-sm">
                                                <a href="{{ Storage::url($plan->fundUsage) }}">fundUsage.pdf</a>
                                            </div>
                                            @endif

                                            <x-input-error :messages="$errors->get('fundUsage')" class="mt-2" />
                                        </div>
                                        <div class="mb-4">
                                            <input type="file" class="form-control form-control-alt form-control-lg" id="fundingSchedule_field" name="fundingSchedule" accept="application/pdf">
                                            <label class="form-label" for="fundingSchedule_field">Calendrier prévisionnel</label>
                                            <span class="text-muted fs-sm fst-italic">Taille maximale exigée : 2Mo; Format : pdf</span>

                                            @if( is_object($plan))
                                            <div class="ms-1 fs-sm">
                                                <a href="{{ Storage::url($plan->fundingSchedule) }}">fundingSchedule.pdf</a>
                                            </div>
                                            @endif

                                            <x-input-error :messages="$errors->get('fundingSchedule')" class="mt-2" />
                                        </div>
                                        @if(!is_object($plan))
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-md btn-outline-primary"> {{ __('Poursuivre') }} <i class="si si-arrow-right"></i></button>
                                        </div>
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