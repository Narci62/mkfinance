<x-simple-main-layout>

    <section class="login-register">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">

                    <div class="login-logo__top text-center mb-2">
                        <a href="/">
                        <img src="{{ asset('media/gmedia/monica_finance.png') }}" alt="">
                        </a>
                    </div>

                    <h3 class="login-register__title text-center">Connexion</h3>

                    @if(session('status'))
                        <div class="alert alert-warning">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="login-register__form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="contact-form__input-box">
                            <input type="email" name="email" placeholder="Adresse email*" value="{{old('email')}}" required autofocus>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="contact-form__input-box">
                            <input type="password" name="password" placeholder="Mot de passe*" required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="login-register__checkbox">
                            <input type="checkbox" id="login-register__password">
                            <label for="login-register__password">Se souvenir de Moi?</label>

                        </div>

                        <div class="login-register__info">
                            <button type="submit" class="thm-btn login-register__btn">Se Connecter</button>
                            <div class="login-register__text"><a href="{{ route('password.request') }}">Mot de passe oublié?</a></div>
                        </div>
                        <div class="login-member__info mt-3">
                            <div class="login-register__text">Pas de compte ? <a href="{{ route('register') }}"><u>Créer un compte maintenant!</u></a></div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

</x-simple-main-layout>