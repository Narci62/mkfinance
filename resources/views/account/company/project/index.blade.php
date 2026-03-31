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
                        <div class="col-4 py-3 bg-body-light border-bottom">
                            <a class="text-center" href="{{ route('co.project1') }}">
                                <div class="fs-5 fw-semibold mb-1">
                                    <i class="fa fa-pencil-alt text-dark"></i>
                                </div>
                                <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                                    {{ __('Information de base') }}
                                </p>
                            </a>
                        </div>

                        <div class="col-4 py-3">
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
                    @if(is_object($project) && in_array($project->status,["waiting","validated"]))
                    <div class="text-start">
                        <h4 class="alert alert-warning">{{ __('Vos informations sont en cours de validation.')  }}</h4>
                    </div>
                    @endif
                    <div class="col-lg-12">
                        <div class="block block-rounded">
                            <div class="block-header d-block pb-0 mb-0">
                                <h3 class="block-title">{{ __('Information de base') }}</h3>
                            </div>
                            <div class="block-content pt-0 mt-0">
                                <div class="col-8">
                                    <form method="POST" action="{{ route('co.project1') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" id="titled" name="titled" placeholder="Intitulé" value="{{ is_object($project) ? $project->titled : '' }}" required autofocus>
                                            <label class="form-label" for="titled">{{ __('Intitulé') }}</label>
                                            <x-input-error :messages="$errors->get('titled')" class="mt-2" />
                                        </div>

                                        <div class="form-floating mb-4">
                                            <input type="number" class="form-control" id="totalFundedNeeded" name="totalFundedNeeded" placeholder="Montant total recherché" value="{{ is_object($project) ?  $project->totalFundedNeeded : '' }}" required autofocus>
                                            <label class="form-label" for="totalFundedNeeded">{{ __('Montant total recherché') }}</label>
                                            <x-input-error :messages="$errors->get('totalFundedNeeded')" class="mt-2" />
                                        </div>

                                        <div class="form-floating mb-4">
                                            <input type="number" class="form-control" id="InvestmentAmountfix" name="InvestmentAmountfix" placeholder="Montant d'investissement" value="{{ is_object($project) ? $project->InvestmentAmountfix : '' }}" required autofocus>
                                            <label class="form-label" for="InvestmentAmountfix"> {{ __('Montant d\'investissement') }} </label>
                                            <x-input-error :messages="$errors->get('InvestmentAmountfix')" class="mt-2" />
                                        </div>

                                        <div class="form-floating mb-4">
                                            <input type="number" class="form-control" id="total" name="amountToStart" placeholder="Montant minimum de demarrage" value="{{ is_object($project) ? $project->amountToStart : '' }}" required autofocus>
                                            <label class="form-label" for="amountToStart"> {{ __('Montant minimum de demarrage') }} </label>
                                            <x-input-error :messages="$errors->get('amountToStart')" class="mt-2" />
                                        </div>

                                        <div class="form-floating mb-4">
                                            <textarea class="form-control" maxlength="1000" id="content" name="description" style="height: 150px" placeholder="Décrivez votre projet"> {{ is_object($project) ? $project->description : "" }} </textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <input type="file" class="form-control form-control-alt form-control-lg" id="featured_image" name="featured_image" required accept="image/png, image/jpg">
                                            <label class="form-label" for="featured_image"> {{ __('Image en  vedette') }} </label>
                                            <span class="text-muted fs-sm fst-italic"> {{ __('Taille maximale exigée : 2Mo; Format : png,jpg') }} </span>
                                            <x-input-error :messages="$errors->get('featured_image')" class="mt-2" />
                                        </div>

                                        <div class="mb-4">
                                            <input type="file" class="form-control form-control-alt form-control-lg" id="makeStudy" name="makeStudy" accept="application/pdf">
                                            <label class="form-label" for="makeStudy"> {{ __('Etude du marché') }} </label>
                                            <span class="text-muted fs-sm fst-italic"> {{ __('Taille maximale exigée : 2Mo; Format : pdf') }} </span>

                                            @if( is_object($project))
                                            <div class="ms-1 fs-sm">
                                                <a href="{{ Storage::url($project->makeStudy) }}">makeStudy.pdf</a>
                                            </div>
                                            @endif

                                            <x-input-error :messages="$errors->get('makeStudy')" class="mt-2" />
                                        </div>
                                        @if(!is_object($project))
                                        <div class="text-start">
                                            <button type="submit" class="btn btn-md btn-outline-secondary"> {{ __('Poursuivre') }} <i class="si si-arrow-right"></i></button>
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