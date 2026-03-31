<x-app-layout>
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <div>
          <h1 class="h3 mb-1 text-capitalize">
            {{ __('Salut') }} {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} 👋
          </h1>
          <p class="fw-medium mb-0 text-muted">
            Gérez vos <a class="fw-medium" href="{{route('in.investments')}}">investissements</a> depuis votre espace de travail.
          </p>
        </div>
        {{-- <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1> --}}
      </div>
    </div>
  </div>

  <div class="content">
    @if(!is_object($investment))
    <div class="block block-rounded">
      <div class="block-content text-center">
        <h4 class="text-muted">Rien à afficher pour le moment ...</h4>
        <p>
          Parcourez <a class="fw-medium" href="{{route('projects')}}">les projets d'entreprise </a> et investissez pour commencer à voir les statistiques de votre compte.
        </p>
      </div>
    </div>
    @else
    <div class="row items-push mb-4">
      <div class="col-sm-6 col-xl-3">
        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
          <div class="block-content block-content-full">
            <div class="item rounded-3 bg-body mx-auto my-3">
              <i class="fa fa-wallet fa-md text-primary"></i>
            </div>
            <div class="fs-3 fw-bold">{{ format_money($wallet->getwallet()->solde) }}</div>
            <div class="text-muted mb-3">Solde de votre compte</div>
            <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
                            <i class="fa fa-caret-down me-1"></i>
                            0.3%
                        </div> -->
          </div>
          <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
            <a class="fw-medium" href="{{route('in.wallet')}}">
              {{ __('Consulter mon Portefeuille') }}
              <i class="fa fa-arrow-right ms-1 opacity-25"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-xl-3">
        <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
          <div class="block-content block-content-full flex-grow-1">
            <div class="item rounded-3 bg-body mx-auto my-3">
              <i class="fa fa-wallet fa-md text-primary"></i>
            </div>
            <div class="fs-3 fw-bold">{{ format_money($investment->sum('amount'))  }}</div>
            <div class="text-muted mb-3"> {{ __('Total investissement') }} </div>
            <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-light">
                            <i class="fa fa-caret-up me-1"></i>
                            7.9%
                        </div> -->
          </div>
          <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
            <a class="fw-medium" href="{{route('in.wallet')}}">
              {{ __('Consulter mon Portefeuille') }}
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
            <div class="fs-3 fw-bold">{{ $investment->count() }}</div>
            <div class="text-muted mb-3"> {{ __('Projets') }} </div> {{--
           <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-light">
                            <i class="fa fa-caret-up me-1"></i>
                            7.9%
                        </div>  --}}
          </div>
          <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
            <a class="fw-medium" href="{{route('in')}}">
              {{ __('Consulter les investissements') }}
              <i class="fa fa-arrow-right ms-1 opacity-25"></i>
            </a>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <div class="block block-rounded block-mode-loading-refresh">
          <div class="block-header block-header-default">
            <h3 class="block-title">
              Dernier investissement
            </h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                <i class="si si-refresh"></i>
              </button>
            </div>
          </div>
          <div class="block-content block-content-full flex-grow-1">
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
                @if(! is_object($investment))
                <tr>
                  <td colspan="5" class="text-center fw-semibold">{{ __('Données vide') }}</td>
                </tr>
                @else
                <tr>
                  <td>
                    <span class="fw-semibold">{{ $investment->project->titled }}</span>
                  </td>
                  <td class="d-none d-xl-table-cell">
                    <span class="fs-sm text-muted">{{ format_date($investment->created_at) }}</span>
                  </td>
                  <td>
                    @if($investment->status == "en cour")
                    <span class="fw-semibold text-warning">{{$investment->status}}</span>
                    @elseif($investment->status == "demarrer")
                    <span class="fw-semibold text-success">{{$investment->status}}</span>
                    @else
                    <span class="fw-semibold text-danger">{{$investment->status}}</span>
                    @endif
                  </td>
                  <td class="d-none d-sm-table-cell text-end fw-medium">
                    {{  format_money($investment->amount) }}
                  </td>
                  <td class="text-center text-nowrap fw-medium">
                    <a href="{{ route('project.view',["id"=>$investment->project->imat]) }}">
                      Voir le project
                    </a>
                  </td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
            <a class="fw-medium" href="{{route('in.investments')}}">
              {{ __('Consulter mes investissements') }}
              <i class="fa fa-arrow-right ms-1 opacity-25"></i>
            </a>
          </div>
        </div>
      </div>

    </div>

    @endif
  </div>

</x-app-layout>