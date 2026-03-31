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
                            <i class="fa fa-dollar text-white-50 me-1"></i>
                            Mon Portefeuille
                        </h1>
                        <a class="btn btn-primary my-2" href="{{ route('projects') }}">
                            <i class="fa fa-fw fa-plus opacity-50"></i>
                            <span class="d-none d-sm-inline ms-1">New Project</span>
                        </a>
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
                <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full">
                        <div class="item rounded-3 bg-body mx-auto my-3">
                            <i class="fa fa-wallet fa-md text-primary"></i>
                        </div>
                        <div class="fs-1 fw-bold">$4,920</div>
                        <div class="text-muted mb-3">Investissement Total</div>
                        <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
                            <i class="fa fa-caret-down me-1"></i>
                            0.3%
                        </div> -->
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                        <a class="fw-medium" href="/account/wallet">
                            Consulter Portefeuille
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1">
                        <div class="item rounded-3 bg-body mx-auto my-3">
                            <i class="fa fa-users fa-md text-primary"></i>
                        </div>
                        <div class="fs-1 fw-bold">006</div>
                        <div class="text-muted mb-3">Investisseurs Confirmés</div>
                        <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-light">
                            <i class="fa fa-caret-up me-1"></i>
                            7.9%
                        </div> -->
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                        <a class="fw-medium" href="/account/investors">
                            Consulter les activités
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
                            Derniers investissements
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
                                    <th>Product</th>
                                    <th class="d-none d-xl-table-cell">Date</th>
                                    <th>Status</th>
                                    <th class="d-none d-sm-table-cell text-end" style="width: 120px;">Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="fw-semibold">Airpods Pro</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        <span class="fs-sm text-muted">yesterday</span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-success">Completed</span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-end fw-medium">
                                        $39,99
                                    </td>
                                    <td class="text-center text-nowrap fw-medium">
                                        <a href="">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm text-center">
                        <a class="fw-medium" href="/account/investments">
                            Tous les investissements
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
                                Commentaires <span class="fw-bolder">(00 news)</span>
                            </p>
                        </div>
                        <div class="item rounded-circle bg-body">
                            <i class="fa fa-check fa-lg text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm text-center">
                        <a class="fw-medium" href="/account/posts">
                            Cosulter les news
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>