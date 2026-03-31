<x-app-layout>
    <div class="bg-body-light">
        @if($complete_account !="")
        <div class="alert alert-warning text-center mb-0" style="border-radius: 0px;" role="alert">
            <p class="mb-0"><b>{{ Auth::user()->firstname }}</b>, complétez les informations de <a class="alert-link text-decoration-underline" href="{{ route('co.profile') }}">votre profil</a> pour valider votre compte !</p>
        </div>
        @endif
        <div class="bg-image" style="background-image: url('assets/media/photos/photo13@2x.jpg');">
            <div class="bg-black-50">
                <div class="content content-full">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="flex-grow-1 fs-2 text-white my-2">
                            <i class="fa fa-boxes text-white-50 me-1"></i>
                            @if(Auth::user()->company AND Auth::user()->company->status >= 1)
                            {{Auth::user()->company->name}}
                            @endif
                        </h1>
                        @if(!$project)
                        <a class="btn btn-primary my-2" href="{{ route('co.project1') }}">
                            <i class="fa fa-fw fa-plus opacity-50"></i>
                            <span class="d-none d-sm-inline ms-1">{{ __('Soumettre mon project') }}</span>
                        </a>
                        @elseif(!$project->funding_plan || !$project->roi_plan)
                        <a class="btn btn-primary my-2" href="{{ route('co.project1') }}">
                            <i class="fa fa-fw fa-plus opacity-50"></i>
                            <span class="d-none d-sm-inline ms-1">{{ __('Poursuivre') }}</span>
                        </a>
                        @endif
                    </div>
                </div>
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
        <div class="row items-push mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded bg-warning-light text-center d-flex flex-column h-100 mb-0">
                    @if(is_object($project))
                    <div class="block-content block-content-full flex-grow-1">
                        <div class="block-content py-5">
                            <div class="item rounded-circle bg-xsmooth-lighter mx-auto mb-3">
                                <i class="fa fa-sync fa-spin text-xsmooth-dark"></i>
                            </div>{{--
                            <p class="fw-semibold fs-xs text-muted text-dark text-uppercase mb-0">
                                
                            </p>--}}
                            <span>En cours de validation</span>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                        <a class="fw-medium" href="{{ route('project.view',['id'=>$project->imat]) }}">
                            Voir  le project
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                    @else
                    <div class="block-content block-content-full flex-grow-1">
                        <div class="block-content py-5">
                            <div class="item rounded-circle bg-xsmooth-lighter mx-auto mb-3">
                                <i class="fa fa-sync fa-spin text-xsmooth-dark"></i>
                            </div>{{--
                            <p class="fw-semibold fs-xs text-muted text-dark text-uppercase mb-0">
                                
                            </p>--}}
                            <span>Aucun projet</span>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1">
                        <div class="item rounded-3 bg-body mx-auto my-3">
                            <i class="fa fa-star fa-md text-primary"></i>
                        </div>
                        <div class="fs-1 fw-bold">{{ $average_avis }}</div>
                        <div class="text-muted mb-3">Note Moyenne</div>
                        <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
                            <i class="fa fa-caret-down me-1"></i>
                            2.3%
                        </div> -->
                    </div>
                    @if(is_object($project))
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                        <a class="fw-medium" href="{{ route('project.view',['id'=>$project->imat]) }}">
                            Voir les avis
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1">
                        <div class="item rounded-3 bg-body mx-auto my-3">
                            <i class="fa fa-users fa-md text-primary"></i>
                        </div>
                        <div class="fs-1 fw-bold">{{$project?->investment->count() ?? 0 }}</div>
                        <div class="text-muted mb-3">Investisseurs Confirmés</div>
                        <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-light">
                            <i class="fa fa-caret-up me-1"></i>
                            7.9%
                        </div> -->
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                        <a class="fw-medium" href="{{route('co.investors')}}">
                            Consulter les activités
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full">
                        <div class="item rounded-3 bg-body mx-auto my-3">
                            <i class="fa fa-wallet fa-md text-primary"></i>
                        </div>
                        <div class="fs-3 fw-bold">{{ format_money($project?->investment->count() * $project?->InvestmentAmountfix)}} </div>
                        <div class="text-muted mb-3">Investissement collecté</div>
                        <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
                            <i class="fa fa-caret-down me-1"></i>
                            0.3%
                        </div> -->
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                        <a class="fw-medium" href="{{route('co.wallet')}}">
                            Consulter Portefeuille
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-md-8">
                <div class="block block-rounded block-mode-loading-refresh">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            Dernier investisseur
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content">
                        <table class="table table-striped table-hover table-borderless table-vcenter fs-sm">
                            <thead>
                                <tr class="text-uppercase">
                                    <th>Matricule</th>
                                    <th class="d-none d-xl-table-cell">Nom & Prénom</th>
                                    <th>Date d'investissement</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($latest_investor == null)
                                <tr class="text-center">
                                    <td colspan="3" >Aucune donnée</td>
                                </tr>
                                @else
                                <tr>
                                    <td>
                                        <span class="fw-semibold">{{ $latest_investor->investors->matricule }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        <span class="fs-sm text-muted">{{ $latest_investor->investors->firstname . " " . $latest_investor->investors->lastname }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($latest_investor->created_at)->translatedFormat('l j Y') }}</span>
                                    </td>
                                    <td class="text-center text-nowrap fw-medium">
                                        <a href="">
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm text-center">
                        <a class="fw-medium" href="{{route('co.investors')}}">
                            Tous les investisseurs
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-flex flex-column">
                <div class="block block-rounded">
                    <div class="block-content block-content-full d-flex justify-content-between align-items-center flex-grow-1">
                        <div class="me-3">
                            <p class="fs-3 fw-bold mb-0">
                                0
                            </p>
                            <p class="text-muted mb-0">
                                Commentaires <span class="fw-bolder">( {{$count_new}} news)</span>
                            </p>
                        </div>
                        <div class="item rounded-circle bg-body">
                            <i class="fa fa-check fa-lg text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm text-center">
                        <a class="fw-medium" href="{{route('co.posts')}}">
                            Consulter les news
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>