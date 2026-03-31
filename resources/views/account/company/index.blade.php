<x-app-layout>
    <div class="bg-body-light">
    @if($complete_account)
    <div class="alert alert-warning text-center" style="border-radius: 0px;" role="alert">
      <p class="mb-0"><b>{{ Auth::user()->firstname }}</b>, complétez les informations de <a class="alert-link text-decoration-underline" href="{{ route('co.profile') }}">votre profil</a> pour valider votre compte !</p>
    </div>
    @endif
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div>
                    <h1 class="h3 mb-1 text-capitalize">
                        Salut {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} 👋
                    </h1>
                    <p class="fw-medium mb-0 text-muted">
                      Gérez <a class="fw-medium" href="{{ route('co.overview') }}">votre entreprise</a> et vos <a class="fw-medium" href="javascript:void(0)">investisseurs</a> depuis votre espace de travail.
                    </p>
                  </div>
                {{-- <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"></h1> --}}
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade modal-dialog modal-dialog-scrollable" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      Testez sans localStorage (optionnel)
Si vous avez ajouté la logique de localStorage pour empêcher la réaffichage de la modale, essayez temporairement de la désactiver pour vérifier que le problème ne vient pas de là.

Si le problème persiste malgré tout, fournissez plus de détails (par exemple, les erreurs dans la console ou le code utilisé).
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

    <div class="content">
        <div class="block block-rounded">
            <div class="block-content text-center">
                <h4 class="text-muted">Rien à afficher pour le moment ...</h4>
                <p>
                    <a class="fw-medium" href="javascript:void(0)">Complétez et publiez</a> votre entreprise pour commencer à voir les statistiques de votre compte.
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
{{--
     <div class="content">
        <div class="row items-push mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded bg-warning-light text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1">
                        <div class="block-content py-5">
                            <div class="item rounded-circle bg-xsmooth-lighter mx-auto mb-3">
                                <i class="fa fa-sync fa-spin text-xsmooth-dark"></i>
                            </div>
                            <p class="fw-semibold fs-xs text-muted text-dark text-uppercase mb-0">
                                Projet soumis
                            </p>
                            <span>En cours de validation</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1">
                        <div class="item rounded-3 bg-body mx-auto my-3">
                            <i class="fa fa-star fa-md text-primary"></i>
                        </div>
                        <div class="fs-1 fw-bold">4.6</div>
                        <div class="text-muted mb-3">Note Moyenne</div>
                        <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
                            <i class="fa fa-caret-down me-1"></i>
                            2.3%
                        </div> -->
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                        <a class="fw-medium" href="/account/reviews">
                            Voir les avis
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
                                        <a href="/account/investment/:id">
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
                                698
                            </p>
                            <p class="text-muted mb-0">
                                Commentaires <span class="fw-bolder">(12 aticles)</span>
                            </p>
                        </div>
                        <div class="item rounded-circle bg-body">
                            <i class="fa fa-check fa-lg text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light fs-sm text-center">
                        <a class="fw-medium" href="/account/posts">
                            Cosulter les articles
                            <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        --}}
    </div> 

    @section('jsbtm')

    <script>
    // Vérifiez si c'est la première visite avec le stockage local
    /*if (localStorage.getItem('modalShown')) {
        // Afficher la modale au chargement de la page
        
        document.addEventListener('DOMContentLoaded', function () {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        myModal.show();

        // Marquer la modale comme déjà affichée
        localStorage.setItem('modalShown', 'true');
        });
    }*/
    </script>


    @endsection

</x-app-layout>