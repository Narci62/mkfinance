<x-simple-app-layout>
    <div class="content content-full">
        <div class="px-3 py-5">
            <div class="mb-3 text-center">
                <a class="link-fx fw-bold fs-1" href="/">
                    <img src="{{ asset('media/brand/monicafinance_logo_dark.png') }}" width="130" alt="">
                </a>
            </div>

            <div class="row g-0 d-flex justify-content-center">
                <div class="col-md-8 col-xl-5 text-center">
                    <p class="text-capitalize fw-bold fs-lg">Confirmez votre adresse email</p>
                    <hr>
                    @if (!session('status') OR session('status') != 'verification-link-sent')
                        <div class="alert alert-warning d-flex align-items-center justify-content-center" role="alert">
                            <div class="flex-grow-1 text-center me-3">
                            <p class="mb-0">{{ __('Merci de vous être inscrit ! Avant de commencer, pourriez-vous vérifier votre adresse électronique en cliquant sur le lien que nous venons de vous envoyer par courrier électronique ? Si vous n\'avez pas reçu l\'e-mail, nous vous en enverrons un autre avec plaisir.') }}</p>
                            </div>
                        </div>
                    @endif

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success d-flex align-items-center justify-content-center" role="alert">
                            <div class="flex-grow-1 text-center me-3">
                                <p class="mb-0">{{ __('Un nouveau lien de vérification a été envoyé à l\'adresse électronique que vous avez fournie lors de votre inscription.') }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-center">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                
                            <div>
                                <button class="btn btn-light text-muted"> <i class="fa fa-envelope"></i> {{ __('Renvoyer le mail de confirmation') }}</button>
                            </div>
                        </form>
                      </div>
                </div>
            </div>

        </div>
    </div>
</x-simple-app-layout>
