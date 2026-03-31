<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocalizationController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::find(Auth::user()->id);

        // Valider la requête pour s'assurer que la locale est supportée
        $request->validate([
            'locale' => 'required|in:' . implode(',', array_keys(config('localization.locales'))),
        ]);

        // Récupérer la locale choisie
        $locale = $request->input('locale');

        $user->update([
            'language' => $locale,
        ]);

        // dd($locale);

        // Mettre à jour la session pour stocker la locale
        // Session::put('localization', $locale);

        // Définir la locale pour l'application
        // app()->setLocale($locale);

        session(['localization' => $locale]);

        // Rediriger l'utilisateur vers la page précédente avec un message de succès
        return redirect()->back()->with('success', __('Langue mise à jour avec succès!'));
    }
}
