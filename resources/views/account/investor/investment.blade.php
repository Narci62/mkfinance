<x-app-layout>
    <div class="bg-body-light">
        @if($complete_account)
        <div class="alert alert-warning text-center" style="border-radius: 0px;" role="alert">
            <p class="mb-0"><b>{{ Auth::user()->firstname }}</b>, complétez les informations de <a class="alert-link text-decoration-underline" href="{{ route('in.profile') }}">votre profil</a> pour valider votre compte !</p>
        </div>
        @endif
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div>
                    <h1 class="h3 mb-1 text-capitalize">
                        {{ __('Mes investissements') }}
                    </h1>
                </div>
                {{-- <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1> --}}
            </div>
        </div>
    </div>

    <div class="content">
        <div class="block block-rounded">
            <table class="table table-striped table-hover table-borderless table-vcenter fs-sm">
                <thead>
                    <tr class="text-uppercase">
                        <th>Titre</th>
                        <th class="d-none d-xl-table-cell">Date</th>
                        <th>Status</th>
                        <th class="d-none d-sm-table-cell text-end" style="width: 120px;">Montant</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($investments) == 0)
                    <tr>
                        <td colspan="5" class="text-center fw-semibold">{{ __('Données vide') }}</td>
                    </tr>
                    @endif
                    @foreach($investments as $investment)
                    <tr>
                        <td>
                            <span class="fw-semibold">{{ $investment->project->titled }}</span>
                        </td>
                        <td class="d-none d-xl-table-cell">
                            <span class="fs-sm text-muted">{{ \Carbon\Carbon::parse($investment->created_at)->translatedFormat('j F Y') }}</span>
                        </td>
                        <td>
                            @if($investment->status == "en cours")
                            <span class="fw-semibold text-warning">{{$investment->status}}</span>
                            @elseif($investment->status == "demarrer")
                            <span class="fw-semibold text-success">{{$investment->status}}</span>
                            @else
                            <span class="fw-semibold text-danger">{{$investment->status}}</span>
                            @endif
                        </td>
                        <td class="d-none d-sm-table-cell text-end fw-medium">
                            {{ $investment->amount }}
                        </td>
                        <td class="text-center text-nowrap fw-medium">
                            <a href="{{ route('project.view',["id"=>$investment->project->imat]) }}">
                                Voir le project
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</x-app-layout>