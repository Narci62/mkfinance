<div class="container">
    <h1>403 - Accès refusé</h1>
    <p>Désolé, vous n'êtes pas autorisé à accéder à cette page.</p>
    @if(Auth::check())
        @if(Auth::user()->account_type == 'company')
            <a href="{{ route('co') }}" class="btn btn-primary">Retour</a>
        @elseif(Auth::user()->account_type == 'investor')
            <a href="{{ route('in') }}" class="btn btn-primary">Retour</a>
        @else
            <a href="{{ route('home') }}" class="btn btn-primary">Retour</a>
        @endif
    @endif
</div>