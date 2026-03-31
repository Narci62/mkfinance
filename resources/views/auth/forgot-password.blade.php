<x-simple-main-layout>
    <section class="login-register">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">

                    @if(session('status'))
                        <div class="alert alert-warning">
                            {{ session('status') }}
                        </div>
                    @else
                        <div class="login-register__warning text-center">
                            <strong>
                                <b>{{__('Vous avez oublié votre mot de passe ?')}}</b><br/>
                                {{__('Renseignez votre adresse email. Nous vous envoyons dans un petit moment un lien pour la réinisialisation de votre mot de passe.')}}
                            </strong>
                        </div>
                    @endif

                    <form class="login-register__form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="contact-form__input-box">
                            <input type="text" name="email" placeholder="Adresse email" required autofocus>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="login-register__info d-flex justify-content-center">
                            <button type="submit" class="thm-btn login-register__btn">{{ __('Réinitialiser mon mot de passe') }}</button>
                        </div>
                        <div class="login-member__info mt-3 text-center">
                            <div class="login-register__text"><a href="{{ route('login') }}"><u>Connexion</u></a> avec votre mot de passe</div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</x-simple-main-layout>