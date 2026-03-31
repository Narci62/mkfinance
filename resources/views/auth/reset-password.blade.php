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
                                <b>{{__('Créez votre nouveau mot de passe')}}</b><br/>
                            </strong>
                        </div>
                    @endif

                    <form class="login-register__form" method="POST" action="{{ route('password.store') }}">
                        @csrf

                         <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="contact-form__input-box">
                            <input type="text" name="email" placeholder="Adresse email" required autofocus>
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

                        <div class="login-register__info d-flex justify-content-center">
                            <button type="submit" class="thm-btn login-register__btn">{{ __('Réinitialiser mon mot de passe') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</x-simple-main-layout>