<x-app-layout>
    <div class="bg-body-light">
        
        <div class="bg-image" style="background-image: url('assets/media/photos/photo13@2x.jpg');">
            <div class="bg-black-50">
                <div class="content content-full">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="flex-grow-1 fs-2 text-white my-2">
                            <i class="fa fa-boxes text-white-50 me-1"></i>
                            {{ __('Mes Articles') }}
                        </h1>
                        <a class="btn btn-primary my-2" href="{{ route('co.newpost') }}">
                            <i class="fa fa-fw fa-plus opacity-50"></i>
                            <span class="d-none d-sm-inline ms-1">{{ __('Ajouter') }}</span>
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

        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded block-mode-loading-refresh">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            Liste des articles
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
                                    <th>Titre</th>
                                    <th class="d-none d-xl-table-cell">Date</th>
                                    <th>Status</th>
                                    <th class="d-none d-sm-table-cell text-end" style="width: 120px;">Questions</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts==null || count($posts) == 0)
                                <tr>
                                    <td colspan="4" class="text-center fw-semibold">{{ __('Données vide') }}</td>
                                </tr>
                                @else
                                @foreach($posts as  $post)
                                <tr>
                                    <td>
                                        <span class="fw-semibold">{{ $post->title }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        <span class="fs-sm text-muted">{{format_date($post->create_at) }}</span>
                                    </td>
                                    <td>
                                        @if($post->status == 0)
                                        <span class="fw-semibold text-warning">Non publié</span>
                                        @else
                                        <span class="fw-semibold text-success">publié</span>
                                        @endif
                                    </td>
                                    <td class="d-none d-sm-table-cell text-end fw-medium">
                                        0
                                    </td>
                                    <td class="text-center text-nowrap fw-medium">
                                        <a href="">
                                            Voir
                                        </a>
                                        @if($post->status == 0)
                                        <a href="">
                                            publier
                                        </a>
                                        @else
                                        <a href="">
                                            depublier
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>


</x-app-layout>