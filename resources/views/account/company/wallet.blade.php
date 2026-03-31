<x-app-layout>
    <div class="bg-body-light">{{--
        <div class="alert alert-warning text-center mb-0" style="border-radius: 0px;" role="alert">
            <p class="mb-0"><b>{{ Auth::user()->firstname }}</b>, complétez les informations de <a class="alert-link text-decoration-underline" href="{{ route('co.profile') }}">votre profil</a> pour valider votre compte !</p>
        </div>--}}
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!$project)

    <div class="content">

        <div class="block block-rounded">
            <div class="block-content text-center">
                <h4 class="text-muted">Rien à afficher pour le moment ...</h4>
                <p>
                    <a class="fw-medium" href="{{ route('co.project1') }}">Rédiger</a> votre projet pour commencer à voir les statistiques de votre compte.
                </p>
            </div>
        </div>
        {{-- <div class="block block-rounded">
            <div class="block-content py-3 text-center">
                <h3 class="h4">Vos premiers pas avec Monica Finance</h3>
                <p>
                    Nous allons vous guider dans la configuration de votre compte. Cliquez "Démarrer" pour commencer.
                </p>
                <button type="button" class="btn btn-hero btn-success js-click-ripple-enabled" data-toggle="click-ripple" style="overflow: hidden; position: relative; z-index: 1;"><span class="click-ripple animate" style="height: 124px; width: 124px; top: -47.5px; left: 1.80005px;"></span>Démarrer</button>
            </div>
        </div> --}}
    </div>
    @else
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
                <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full">
                        <div class="item rounded-3 bg-body mx-auto my-3">
                            <i class="fa fa-wallet fa-md text-primary"></i>
                        </div>
                        <div class="fs-3 fw-bold">{{ format_money($monwallet->solde) }}</div>
                        <div class="text-muted mb-3">Solde principal</div>
                        <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
                            <i class="fa fa-caret-down me-1"></i>
                            0.3%
                        </div> -->
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                        <a class="fw-medium" href="">
                            Recharger mon compte
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
                        <div class="fs-3 fw-bold">{{ format_money($project->totalFundedNeeded)}}</div>
                        <div class="text-muted mb-3">Fond d'investissement attendu</div>
                        <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
                            <i class="fa fa-caret-down me-1"></i>
                            0.3%
                        </div> -->
                    </div>
                    
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full">
                        <div class="item rounded-3 bg-body mx-auto my-3">
                            <i class="fa fa-wallet fa-md text-primary"></i>
                        </div>
                        <div class="fs-3 fw-bold">{{ format_money($project->investment->count() * $project->InvestmentAmountfix)}} </div>
                        <div class="text-muted mb-3">Fond Collectés</div>
                        <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
                            <i class="fa fa-caret-down me-1"></i>
                            0.3%
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full">
                        <div class="item rounded-3 bg-body mx-auto my-3">
                            <i class="fa fa-wallet fa-md text-primary"></i>
                        </div>
                        <div class="fs-3 fw-bold">{{ format_money(-($project->investment->count() * $project->InvestmentAmountfix) + $project->totalFundedNeeded)  }}</div>
                        <div class="text-muted mb-3">Restant</div>
                        <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
                            <i class="fa fa-caret-down me-1"></i>
                            0.3%
                        </div> -->
                    </div>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded block-mode-loading-refresh">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            Historique des opérations
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
                                    <th>Type</th>
                                    <th class="d-none d-xl-table-cell">Montant</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($operations->count() == 0)
                                <tr class="text-center">
                                    <td colspan="3" >Aucune donnée</td>
                                </tr>
                                @else
                                @foreach($operations as $operation)
                                <tr>
                                    <td>
                                        <span class="fw-semibold">{{ $operation->type }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        <span class="fs-sm text-muted">{{ $operation->montant }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">{{ format_date($operation->created_at) }}</span>
                                    </td>
                                    <td class="text-center text-nowrap fw-medium">
                                        <a href="">
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm text-center">
                        <a class="fw-medium" href="">
                            --
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</x-app-layout>