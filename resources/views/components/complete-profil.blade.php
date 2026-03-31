@props(["user"=> Auth::user()])
<div class="alert alert-warning text-center" style="border-radius: 0px;" role="alert">
    <p class="mb-0"><b>{{ $user->firstname }}</b>, complétez les informations de <a class="alert-link text-decoration-underline" href="{{ route('co.profile') }}">votre profil</a> pour valider votre compte !</p>
</div>