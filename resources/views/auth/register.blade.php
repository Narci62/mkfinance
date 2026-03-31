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
                    <h3 class="login-register__title text-center">Créer un compte</h3>

                    <form class="login-register__form" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="register_input_box">
                            <div class="select-box">
                                <select name="account_type" class="wide" required>
                                    <option data-display="Que souhaitez-vous faire ?">Que souhaitez-vous faire ?</option>
                                    <option value="company">Soumettre un projet</option>
                                    <option value="investor">Investir</option>
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('account_type')" class="mt-2" />
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="contact-form__input-box">
                                    <input type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Entrez votre nom" required autofocus autocomplete="lastname">
                                    <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="contact-form__input-box">
                                    <input type="text" name="firstname" value="{{ old('firstname') }}" placeholder="Entrez votre prénom" required autocomplete="firstname">
                                    <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="contact-form__input-box">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Entrez votre adresse email" required autocomplete="email">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="contact-form__input-box">
                            <input type="password" name="password" placeholder="Entrez un mot de passe" required autocomplete="password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="contact-form__input-box">
                            <input type="password" name="password_confirmation" placeholder="Confirmez le mot de passe" required autocomplete="password_confirmation">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="login-register__checkbox">
                            <input type="checkbox" id="login-register__policy">
                            <label for="login-register__policy">J'accepte la <a href="#">politique de confidentialité</a>.</label>
                        </div>

                        <div class="login-register__info">
                            <button type="submit" class="thm-btn login-register__btn">Créer un compte</button>
                        </div>

                        <div class="login-member__info mt-3">
                            <div class="login-register__text">Vous avez déjà un compte ? <a href="{{ route('login') }}"><u>Se connecter!</u></a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-simple-main-layout>